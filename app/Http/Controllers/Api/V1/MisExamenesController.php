<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ExamenResource;
use App\Models\Examen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Mpdf\Mpdf;

class MisExamenesController extends Controller
{
    private function authorizeAlumno(Request $request): void
    {
        if ($request->user()->rol !== 'alumno') {
            abort(403, 'Solo los alumnos pueden acceder a este recurso.');
        }
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorizeAlumno($request);

        $examenes = $request->user()->examenesInscritos()->paginate(15);

        return ExamenResource::collection($examenes);
    }

    public function store(Request $request, Examen $examen): JsonResponse
    {
        $this->authorizeAlumno($request);

        $user = $request->user();

        if ($user->examenesInscritos()->where('examen_id', $examen->id)->exists()) {
            return response()->json(['message' => 'Ya estás inscrito en este examen.'], 409);
        }

        $user->examenesInscritos()->attach($examen->id);

        return (new ExamenResource($examen))
            ->response()
            ->setStatusCode(201);
    }

    public function destroy(Request $request, Examen $examen): Response
    {
        $this->authorizeAlumno($request);

        $request->user()->examenesInscritos()->detach($examen->id);

        return response()->noContent();
    }

    public function pdf(Request $request): Response
    {
        $this->authorizeAlumno($request);

        $examenes = $request->user()
            ->examenesInscritos()
            ->where('activo', true)
            ->orderBy('horario')
            ->get();

        $html = view('pdf.calendario-examenes', [
            'examenes' => $examenes,
            'alumno'   => $request->user(),
        ])->render();

        $mpdf = new Mpdf([
            'mode'              => 'utf-8',
            'format'            => 'A4',
            'margin_top'        => 10,
            'margin_right'      => 14,
            'margin_bottom'     => 18,
            'margin_left'       => 14,
            'margin_footer'     => 6,
        ]);
        $mpdf->SetTitle('Calendario de Exámenes — ' . $request->user()->name);
        $mpdf->SetAuthor('bitest');
        $mpdf->WriteHTML($html);
        $content = $mpdf->Output('', 'S');

        return response($content, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="calendario-examenes.pdf"',
        ]);
    }

    public function ical(Request $request): Response
    {
        $this->authorizeAlumno($request);

        $examenes = $request->user()
            ->examenesInscritos()
            ->where('activo', true)
            ->orderBy('horario')
            ->get();

        $lines = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//bitest//Calendario Examenes//ES',
            'CALSCALE:GREGORIAN',
            'METHOD:PUBLISH',
        ];

        foreach ($examenes as $examen) {
            array_push($lines, ...$this->veventLines($examen));
        }

        $lines[] = 'END:VCALENDAR';

        return response(implode("\r\n", $lines), 200, [
            'Content-Type'        => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="calendario-examenes.ics"',
        ]);
    }

    public function icalExamen(Request $request, Examen $examen): Response
    {
        $this->authorizeAlumno($request);

        if (! $request->user()->examenesInscritos()->where('examen_id', $examen->id)->exists()) {
            abort(403, 'No estás inscrito en este examen.');
        }

        $lines = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//bitest//Calendario Examenes//ES',
            'CALSCALE:GREGORIAN',
            'METHOD:PUBLISH',
            ...$this->veventLines($examen),
            'END:VCALENDAR',
        ];

        $slug = str($examen->unidadAprendizaje->nombre)->slug()->value();

        return response(implode("\r\n", $lines), 200, [
            'Content-Type'        => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="examen-' . $slug . '.ics"',
        ]);
    }

    private function veventLines(Examen $examen): array
    {
        return [
            'BEGIN:VEVENT',
            'UID:examen-' . $examen->id . '@bitest',
            'DTSTART:' . $examen->horario->format('Ymd\THis\Z'),
            'DTEND:' . $examen->horario->copy()->addHours(2)->format('Ymd\THis\Z'),
            'SUMMARY:' . $examen->unidadAprendizaje->nombre,
            'LOCATION:' . $examen->salon->nombre,
            'DESCRIPTION:Profesor: ' . $examen->profesor->nombre,
            'END:VEVENT',
        ];
    }
}

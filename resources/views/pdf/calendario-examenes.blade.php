<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
  * { margin: 0; padding: 0; }

  body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 10px;
    color: #0f172a;
    background: #ffffff;
  }

  /* ── PAGE FOOTER ────────────────────────────── */
  .footer-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 8px;
    color: #94a3b8;
  }
  .footer-table td {
    padding: 6px 0 0;
    border-top: 1px solid #e2e8f0;
  }

  /* ── HEADER ─────────────────────────────────── */
  .header-outer {
    width: 100%;
    background-color: #1e3a8a;
    border-collapse: collapse;
  }
  .header-outer td {
    padding: 18px 24px 14px;
  }
  .header-brand {
    font-size: 8px;
    color: #93c5fd;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    font-weight: bold;
    margin-bottom: 5px;
  }
  .header-title {
    font-family: DejaVu Serif, serif;
    font-size: 20px;
    color: #ffffff;
    font-weight: bold;
    margin-bottom: 3px;
  }
  .header-sub {
    font-size: 9px;
    color: #bfdbfe;
  }

  /* ── ACCENT BAR ──────────────────────────────── */
  .accent-bar {
    width: 100%;
    background-color: #2563eb;
    border-collapse: collapse;
    line-height: 0;
  }
  .accent-bar td {
    height: 4px;
    font-size: 1px;
    line-height: 0;
  }

  /* ── INFO CARD ───────────────────────────────── */
  .info-outer {
    width: 100%;
    border-collapse: collapse;
    margin: 14px 0;
    background-color: #eff6ff;
  }
  .info-stripe {
    width: 5px;
    background-color: #2563eb;
    font-size: 1px;
  }
  .info-inner {
    width: 100%;
    border-collapse: collapse;
  }
  .info-inner td {
    padding: 12px 14px;
    vertical-align: top;
  }
  .info-label {
    font-size: 7.5px;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    font-weight: bold;
    margin-bottom: 4px;
  }
  .info-value-lg {
    font-size: 13px;
    color: #0f172a;
    font-weight: bold;
  }
  .info-value-sm {
    font-size: 10px;
    color: #475569;
    margin-top: 2px;
  }
  .info-count {
    font-family: DejaVu Serif, serif;
    font-size: 28px;
    color: #1e3a8a;
    font-weight: bold;
    line-height: 1;
  }
  .info-count-label {
    font-size: 8.5px;
    color: #64748b;
    margin-top: 2px;
  }

  /* ── SECTION HEADING ─────────────────────────── */
  .section-head {
    width: 100%;
    border-collapse: collapse;
    margin: 4px 0 8px;
  }
  .section-head td {
    font-size: 8px;
    font-weight: bold;
    color: #1e3a8a;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    padding-bottom: 5px;
    border-bottom: 2px solid #dbeafe;
  }

  /* ── MAIN TABLE ──────────────────────────────── */
  .exams-table {
    width: 100%;
    border-collapse: collapse;
  }
  .exams-table th {
    background-color: #1e293b;
    color: #f1f5f9;
    padding: 9px 10px;
    text-align: left;
    font-size: 8px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.08em;
  }
  .exams-table td {
    padding: 9px 10px;
    border-bottom: 1px solid #e2e8f0;
    vertical-align: middle;
  }
  .exams-table tr.odd td  { background-color: #ffffff; }
  .exams-table tr.even td { background-color: #f8fafc; }

  /* Cell content helpers */
  .materia-name {
    font-size: 10.5px;
    font-weight: bold;
    color: #0f172a;
  }
  .sem-badge {
    font-size: 7.5px;
    font-weight: bold;
    color: #1d4ed8;
    background-color: #dbeafe;
    padding: 1px 5px;
    border-radius: 3px;
  }
  .date-day {
    font-family: DejaVu Serif, serif;
    font-size: 18px;
    font-weight: bold;
    color: #1e3a8a;
    line-height: 1;
  }
  .date-month {
    font-size: 8px;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
  .date-year {
    font-size: 8px;
    color: #94a3b8;
  }
  .time-text {
    font-size: 11px;
    font-weight: bold;
    color: #0f172a;
  }
  .time-sub {
    font-size: 8px;
    color: #94a3b8;
  }
  .person-name {
    font-size: 10px;
    color: #1e293b;
  }
  .place-name {
    font-size: 10px;
    color: #1e293b;
    font-weight: bold;
  }
  .place-building {
    font-size: 8.5px;
    color: #64748b;
    margin-top: 2px;
  }

  /* ── EMPTY STATE ─────────────────────────────── */
  .empty-cell {
    text-align: center;
    padding: 40px 20px;
    color: #94a3b8;
    font-style: italic;
    font-size: 11px;
  }

  /* ── NOTICE ──────────────────────────────────── */
  .notice-outer {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fefce8;
  }
  .notice-stripe {
    width: 5px;
    background-color: #eab308;
    font-size: 1px;
  }
  .notice-text {
    padding: 9px 14px;
    font-size: 8.5px;
    color: #713f12;
  }
</style>
</head>
<body>

{{-- mPDF page footer --}}
<htmlpagefooter name="footer">
<table class="footer-table">
  <tr>
    <td style="text-align:left;">bitest &middot; Sistema de Gestión de Exámenes</td>
    <td style="text-align:center; color: #64748b;">Documento generado el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i') }} hrs</td>
    <td style="text-align:right;">Página {PAGENO} de {nbpg}</td>
  </tr>
</table>
</htmlpagefooter>
<sethtmlpagefooter name="footer" value="on" />

{{-- ─── HEADER ───────────────────────────────────────────────────────────── --}}
<table class="header-outer" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <p class="header-brand">bitest &nbsp;&middot;&nbsp; Tecnológico Nacional de México</p>
      <p class="header-title">Calendario de Exámenes</p>
      <p class="header-sub">Comprobante oficial de inscripción &mdash; Ciclo {{ now()->format('Y') }}</p>
    </td>
  </tr>
</table>

<table class="accent-bar" cellpadding="0" cellspacing="0">
  <tr><td>&nbsp;</td></tr>
</table>

{{-- ─── INFO CARD ────────────────────────────────────────────────────────── --}}
<table class="info-outer" cellpadding="0" cellspacing="0">
  <tr>
    <td class="info-stripe">&nbsp;</td>
    <td style="padding: 0;">
      <table class="info-inner" cellpadding="0" cellspacing="0">
        <tr>
          <td style="width: 50%; padding: 13px 14px; vertical-align: top;">
            <p class="info-label">Alumno</p>
            <p class="info-value-lg">{{ $alumno->name }}</p>
            <p class="info-value-sm">Matrícula: <strong>{{ $alumno->identificador }}</strong></p>
          </td>
          <td style="width: 22%; padding: 13px 14px; vertical-align: top; border-left: 1px solid #bfdbfe;">
            <p class="info-label">Exámenes Inscritos</p>
            <p class="info-count">{{ $examenes->count() }}</p>
            <p class="info-count-label">{{ $examenes->count() === 1 ? 'examen activo' : 'exámenes activos' }}</p>
          </td>
          <td style="width: 28%; padding: 13px 14px; vertical-align: top; border-left: 1px solid #bfdbfe;">
            <p class="info-label">Fecha de Emisión</p>
            <p class="info-value-lg">{{ now()->format('d/m/Y') }}</p>
            <p class="info-value-sm">{{ now()->format('H:i') }} hrs</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

{{-- ─── SECTION HEADING ─────────────────────────────────────────────────── --}}
<table class="section-head" cellpadding="0" cellspacing="0">
  <tr>
    <td>Detalle de Exámenes</td>
  </tr>
</table>

{{-- ─── MAIN TABLE ──────────────────────────────────────────────────────── --}}
@if($examenes->isEmpty())

<table class="exams-table">
  <tr><td class="empty-cell">No tienes exámenes activos inscritos.</td></tr>
</table>

@else

<table class="exams-table" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th style="width: 33%;">Materia / UA</th>
      <th style="width: 13%;">Fecha</th>
      <th style="width: 9%;">Hora</th>
      <th style="width: 22%;">Profesor</th>
      <th style="width: 23%;">Salón / Edificio</th>
    </tr>
  </thead>
  <tbody>
    @foreach($examenes as $i => $examen)
    <tr class="{{ $i % 2 === 0 ? 'odd' : 'even' }}">

      {{-- Materia --}}
      <td>
        <p class="materia-name">{{ $examen->unidadAprendizaje->nombre }}</p>
        @if($examen->unidadAprendizaje->semestre)
        <p style="margin-top: 3px;">
          <span class="sem-badge">Semestre {{ $examen->unidadAprendizaje->semestre }}</span>
        </p>
        @endif
      </td>

      {{-- Fecha --}}
      <td>
        <p class="date-day">{{ $examen->horario->format('d') }}</p>
        <p class="date-month">{{ $examen->horario->translatedFormat('M') }}</p>
        <p class="date-year">{{ $examen->horario->format('Y') }}</p>
      </td>

      {{-- Hora --}}
      <td>
        <p class="time-text">{{ $examen->horario->format('H:i') }}</p>
        <p class="time-sub">hrs</p>
      </td>

      {{-- Profesor --}}
      <td>
        <p class="person-name">{{ $examen->profesor->nombre }}</p>
        @if($examen->profesor->area)
        <p style="font-size: 8.5px; color: #94a3b8; margin-top: 2px;">{{ $examen->profesor->area->nombre }}</p>
        @endif
      </td>

      {{-- Salón --}}
      <td>
        <p class="place-name">{{ $examen->salon->nombre }}</p>
        @if($examen->salon->edificio)
        <p class="place-building">{{ $examen->salon->edificio->nombre }}</p>
        @endif
      </td>

    </tr>
    @endforeach
  </tbody>
</table>

{{-- ─── NOTICE ──────────────────────────────────────────────────────────── --}}
<table class="notice-outer" cellpadding="0" cellspacing="0" style="margin-top: 18px;">
  <tr>
    <td class="notice-stripe">&nbsp;</td>
    <td class="notice-text">
      Este documento es de carácter informativo. Preséntate con identificación oficial y llega
      con al menos 10 minutos de anticipación. En caso de discrepancias, consulta con Control Escolar.
    </td>
  </tr>
</table>

@endif

</body>
</html>

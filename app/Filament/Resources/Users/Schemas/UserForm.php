<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(
                        ignoreRecord: true,
                        modifyRuleUsing: fn (Rule $rule) => $rule->whereNull('deleted_at'),
                    ),

                TextInput::make('identificador')
                    ->label('Identificador')
                    ->helperText('Boleta para alumnos, clave para administrativos.')
                    ->required()
                    ->maxLength(50)
                    ->unique(
                        ignoreRecord: true,
                        modifyRuleUsing: fn (Rule $rule) => $rule->whereNull('deleted_at'),
                    ),

                Select::make('rol')
                    ->label('Rol')
                    ->required()
                    ->options([
                        'admin' => 'Administrador',
                        'administrativo' => 'Administrativo',
                        'alumno' => 'Alumno',
                    ])
                    ->default('alumno')
                    ->native(false),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->revealable()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->minLength(8)
                    ->confirmed()
                    ->rule(Password::min(8))
                    ->helperText(fn (string $operation): string => $operation === 'edit'
                        ? 'Déjalo vacío para conservar la contraseña actual.'
                        : 'Mínimo 8 caracteres.'),

                TextInput::make('password_confirmation')
                    ->label('Confirmar contraseña')
                    ->password()
                    ->revealable()
                    ->dehydrated(false)
                    ->required(fn (string $operation, Get $get): bool => $operation === 'create' || filled($get('password')))
                    ->visible(fn (string $operation, Get $get): bool => $operation === 'create' || filled($get('password'))),
            ]);
    }
}

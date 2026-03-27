<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cognome' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'), // Standard Laravel
            'remember_token' => Str::random(10),
            'tipo_utente' => fake()->randomElement(['Guest', 'Talent', 'Sponsor', 'Admin', 'Visitatore']),
            'accetta_termini' => true,
            'lingua_preferita' => 'IT',
            'premium' => false,
            'verificato_identita' => false,
            'bannato' => false,
            'telefono' => fake()->optional()->phoneNumber(),
            'prefisso_internazionale' => fake()->optional()->randomElement(['+39', '+1', '+44', '+33']),
            'foto_profilo' => fake()->optional()->imageUrl(),
            'premium_scadenza' => null,
            'ban_scadenza' => null,
            'motivo_ban' => null,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    
    public function talent(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_utente' => 'Talent',
        ]);
    }
    
    public function sponsor(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_utente' => 'Sponsor',
        ]);
    }
    
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_utente' => 'Admin',
        ]);
    }
}
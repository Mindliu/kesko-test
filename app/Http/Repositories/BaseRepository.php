<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepository
{
    public function getNextStatementId(string $tableName): int
    {
        $idSequence = $tableName . '_id_seq';

        // Check if the sequence exists
        $sequenceExists = DB::table('pg_sequences')
            ->where('schemaname', '=', 'public')
            ->where('sequencename', '=', $idSequence)
            ->exists();

        // Create the sequence if it doesn't exist
        if (!$sequenceExists) {
            DB::statement('CREATE SEQUENCE ' . $idSequence);
        }

        // Set the default value using the sequence
        DB::statement("ALTER TABLE $tableName ALTER COLUMN id SET DEFAULT nextval('$idSequence')");

        // Set the starting value for the sequence based on existing data
        DB::statement("SELECT setval('$idSequence', COALESCE((SELECT MAX(id) FROM $tableName), 1))");

        $result = DB::select("SELECT nextval('$idSequence') as next_id");

        return $result[0]->next_id;
    }
}

<?php
namespace App\Services;



class MutationService
{
    public static function hasMutation($dna)
    {
        // Sample DNA sequence
        $n = count($dna);
        $count = 0;

        // Validate NxN and characters
        foreach ($dna as $row) {
            if (strlen($row) != $n) {
                return ['ok' => false, 'message' => 'Not a square matrix'];
            }
            if (preg_match('/^[ATCG]+$/', $row) === 0) {
                return ['ok' => false, 'message' => 'Invalid characters in DNA sequence'];
            }
        }

        // Convert to matrix
        $matrix = array_map('str_split', $dna);

        // HORIZONTAL
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j <= $n - 4; $j++) {
                if ($matrix[$i][$j] === $matrix[$i][$j + 1] &&
                    $matrix[$i][$j] === $matrix[$i][$j + 2] &&
                    $matrix[$i][$j] === $matrix[$i][$j + 3]) {

                    $count++;
                    if ($count >= 2) {
                        return ['ok' => true, 'message' => 'Mutation detected'];
                    }
                }
            }
        }

        // VERTICAL
        for ($i = 0; $i <= $n - 4; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($matrix[$i][$j] === $matrix[$i + 1][$j] &&
                    $matrix[$i][$j] === $matrix[$i + 2][$j] &&
                    $matrix[$i][$j] === $matrix[$i + 3][$j]) {

                    $count++;
                    if ($count >= 2) {
                        return ['ok' => true, 'message' => 'Mutation detected'];
                    }
                }
            }
        }

        // DIAGONAL ↘
        for ($i = 0; $i <= $n - 4; $i++) {
            for ($j = 0; $j <= $n - 4; $j++) {
                if ($matrix[$i][$j] === $matrix[$i + 1][$j + 1] &&
                    $matrix[$i][$j] === $matrix[$i + 2][$j + 2] &&
                    $matrix[$i][$j] === $matrix[$i + 3][$j + 3]) {

                    $count++;
                    if ($count >= 2) {
                        return ['ok' => true, 'message' => 'Mutation detected'];
                    }
                }
            }
        }

        // DIAGONAL INVERTIDA ↙
        for ($i = 0; $i <= $n - 4; $i++) {
            for ($j = 3; $j < $n; $j++) {
                if ($matrix[$i][$j] === $matrix[$i + 1][$j - 1] &&
                    $matrix[$i][$j] === $matrix[$i + 2][$j - 2] &&
                    $matrix[$i][$j] === $matrix[$i + 3][$j - 3]) {

                    $count++;
                    if ($count >= 2) {
                        return ['ok' => true, 'message' => 'Mutation detected'];
                    }
                }
            }
        }

        return ['ok' => false, 'message' => 'No mutation detected'];
    }
}
    
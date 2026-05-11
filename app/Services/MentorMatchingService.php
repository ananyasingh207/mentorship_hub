<?php

namespace App\Services;

use App\Models\MentorProfile;
use App\Models\StartupProfile;

class MentorMatchingService
{
    /**
     * Calculate match score between a startup profile and a mentor profile.
     * Returns a percentage (0–100).
     */
    public static function calculateMatchScore(StartupProfile $startupProfile, MentorProfile $mentorProfile): int
    {
        $score = 0;
        $maxScore = 100;

        $mentorExpertise = strtolower($mentorProfile->expertise);
        $startupIndustry = strtolower($startupProfile->industry);
        $startupHelpNeeded = strtolower($startupProfile->help_needed ?? '');

        // +50 points: startup industry matches mentor expertise
        if (str_contains($mentorExpertise, $startupIndustry) || str_contains($startupIndustry, $mentorExpertise)) {
            $score += 50;
        }

        // +25 points: startup help_needed partially matches mentor expertise
        if (!empty($startupHelpNeeded) && (
            str_contains($mentorExpertise, $startupHelpNeeded) ||
            str_contains($startupHelpNeeded, $mentorExpertise)
        )) {
            $score += 25;
        }

        // +25 points: mentor is approved
        if ($mentorProfile->status === 'approved') {
            $score += 25;
        }

        // Clamp to 100
        $percentage = min(round(($score / $maxScore) * 100), 100);

        return (int) $percentage;
    }

    /**
     * Get mentors sorted by match score for a given startup profile.
     * Returns a collection of mentors with a match_score attribute.
     */
    public static function getMatchedMentors(StartupProfile $startupProfile, int $limit = 5)
    {
        $mentors = MentorProfile::with('user')
            ->where('status', 'approved')
            ->get();

        foreach ($mentors as $mentor) {
            $mentor->match_score = self::calculateMatchScore($startupProfile, $mentor);
        }

        return $mentors->sortByDesc('match_score')->take($limit)->values();
    }
}

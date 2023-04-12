<?php
namespace PromptProcessor2;

class PromptProcessor {
    public static function process(string $prompt, string|array $start, string|array $end) {

        $startsWithMarker = self::startsWith($prompt, $start);
        $endsWithCriteria = self::endsWith($prompt, $end);
        $trimmedPrompt = trim(str_replace($start, '', $prompt));

        if ($startsWithMarker && $endsWithCriteria) {
            return $trimmedPrompt;
        }

        if (strtolower($prompt) === 'hello') {
            $punctuationMarks = ['!', '?'];
            return $prompt . $punctuationMarks[array_rand($punctuationMarks)];
        }

        return '';
    }

    private static function startsWith(string $str, string|array $start): bool {
        if (is_array($start)) {
            foreach ($start as $s) {
                if (stripos($str, $s) === 0) {
                    return true;
                }
            }
            return false;
        }

        return stripos($str, $start) === 0;
    }

    private static function endsWith(string $str, string|array $end): bool {
        if (is_array($end)) {
            foreach ($end as $e) {
                if (substr_compare($str, $e, -strlen($e)) === 0) {
                    return true;
                }
            }
            return false;
        }

        return substr_compare($str, $end, -strlen($end)) === 0;
    }
}
?>

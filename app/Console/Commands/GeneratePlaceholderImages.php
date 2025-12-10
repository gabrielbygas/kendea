<?php
// Modified by Claude

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;

class GeneratePlaceholderImages extends Command
{
    protected $signature = 'images:generate-placeholders';
    protected $description = 'Generate placeholder images for all activities';

    public function handle()
    {
        $this->info('Génération des images placeholder pour les activités...');

        $activities = Activity::all();
        $colors = [
            ['r' => 74, 'g' => 144, 'b' => 226],   // Blue
            ['r' => 135, 'g' => 206, 'b' => 235],  // Sky Blue
            ['r' => 173, 'g' => 216, 'b' => 230],  // Light Blue
            ['r' => 100, 'g' => 149, 'b' => 237],  // Cornflower Blue
            ['r' => 176, 'g' => 196, 'b' => 222],  // Light Steel Blue
        ];

        foreach ($activities as $activity) {
            $imagesPath = storage_path('app/public/activities/' . $activity->slug);

            if (!file_exists($imagesPath)) {
                mkdir($imagesPath, 0775, true);
            }

            // Generate 3-5 images per activity
            $imageCount = count($activity->images);

            for ($i = 1; $i <= $imageCount; $i++) {
                $imagePath = $imagesPath . '/image-' . $i . '.jpg';

                if (!file_exists($imagePath)) {
                    $this->generatePlaceholderImage(
                        $imagePath,
                        $activity->nom,
                        $colors[($i - 1) % count($colors)]
                    );
                }
            }

            $this->info("✓ Images générées pour: {$activity->nom}");
        }

        $this->info("\n✅ Toutes les images placeholder ont été générées avec succès!");
        return 0;
    }

    private function generatePlaceholderImage($path, $text, $color)
    {
        $width = 800;
        $height = 600;

        // Create image
        $image = imagecreatetruecolor($width, $height);

        // Allocate colors
        $bgColor = imagecolorallocate($image, $color['r'], $color['g'], $color['b']);
        $textColor = imagecolorallocate($image, 255, 255, 255);
        $overlayColor = imagecolorallocatealpha($image, 0, 0, 0, 50);

        // Fill background
        imagefill($image, 0, 0, $bgColor);

        // Add gradient effect
        for ($y = 0; $y < $height; $y++) {
            $alpha = intval(($y / $height) * 30);
            $gradientColor = imagecolorallocatealpha($image, 0, 0, 0, $alpha);
            imageline($image, 0, $y, $width, $y, $gradientColor);
        }

        // Add decorative pattern
        for ($i = 0; $i < 50; $i++) {
            $x = rand(0, $width);
            $y = rand(0, $height);
            $size = rand(2, 8);
            $patternColor = imagecolorallocatealpha($image, 255, 255, 255, rand(80, 120));
            imagefilledellipse($image, $x, $y, $size, $size, $patternColor);
        }

        // Wrap text
        $wrappedText = wordwrap($text, 20, "\n");
        $lines = explode("\n", $wrappedText);

        // Calculate text position
        $fontSize = 5; // Built-in font size
        $lineHeight = 20;
        $totalHeight = count($lines) * $lineHeight;
        $startY = ($height - $totalHeight) / 2;

        // Draw text shadow
        foreach ($lines as $index => $line) {
            $textWidth = strlen($line) * 9; // Approximate width for font size 5
            $x = ($width - $textWidth) / 2;
            $y = $startY + ($index * $lineHeight);

            // Shadow
            imagestring($image, $fontSize, $x + 2, $y + 2, $line, $overlayColor);
            // Main text
            imagestring($image, $fontSize, $x, $y, $line, $textColor);
        }

        // Add "Dubai Activities" watermark
        $watermark = "Dubai Activities";
        $watermarkWidth = strlen($watermark) * 7;
        imagestring($image, 3, ($width - $watermarkWidth) / 2, $height - 30, $watermark, $textColor);

        // Save image
        imagejpeg($image, $path, 85);
        imagedestroy($image);
    }
}

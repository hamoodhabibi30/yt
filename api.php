<?php
header("Content-Type: application/json");

// Get the YouTube URL from the request
if (!isset($_GET["url"])) {
    echo json_encode(["error" => "Missing video URL"]);
    exit();
}

$video_url = escapeshellarg($_GET["url"]); // Sanitize input

// Run yt-dlp command to fetch video details
$cmd = "yt-dlp -J " . $video_url;
$output = shell_exec($cmd);

if (!$output) {
    echo json_encode(["error" => "Failed to fetch video details"]);
    exit();
}

// Convert JSON output to PHP array
$video_info = json_decode($output, true);

// Extract useful details
$response = [
    "title" => $video_info["title"] ?? "Unknown",
    "id" => $video_info["id"] ?? null,
    "url" => $video_info["webpage_url"] ?? null,
    "duration" => $video_info["duration"] ?? null,
    "thumbnail" => $video_info["thumbnail"] ?? null,
    "views" => $video_info["view_count"] ?? null,
    "likes" => $video_info["like_count"] ?? null,
    "channel" => $video_info["uploader"] ?? null,
    "stream_url" => $video_info["url"] ?? null
];

echo json_encode($response);
?>

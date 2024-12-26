<?php
$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] :"horoscope";

$rssFeedUrl = 'https://news.google.com/rss/search?q=horoscope' .urlencode($keyword);

$rssFeed = simplexml_load_file($rssFeedUrl);

if ($rssFeed) {
    $articles = [];
    foreach ($rssFeed->channel->item as $item) {
        $articles[] = [
            'title' => (string) $item->title,
            'link' => (string) $item->link,
            'description' => (string) $item->description,
            'pubDate' => (string) $item->pubDate,
        ];
    }
} else {
    echo "Failed to fetch RSS feed.";
}
?>

<h1>Horoscope News Articles</h1>

<?php if (!empty($articles)): ?>
    <?php foreach ($articles as $article): ?>
        <div class="article">
            <h2><a href="<?= $article['link']; ?>"  onclick='return confirmRedirect();' target="_blank"><?= $article['title']; ?></a></h2>
            <p><?= $article['description']; ?></p>
            <small>Published on: <?= date('F j, Y, g:i a', strtotime($article['pubDate'])); ?></small>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No articles found.</p>
<?php endif; ?>
<script src="script.js"></script>
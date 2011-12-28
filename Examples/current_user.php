<?php

require( '_common.php' );

$user = $instagram->getCurrentUser();
$media = $user->getMedia( isset( $_GET['max_id'] ) ? array( 'max_id' => $_GET['max_id'] ) : null );
$follows = $user->getFollows( isset( $_GET['follows_cursor'] ) ? array( 'cursor' => $_GET['follows_cursor'] ) : null );
$followers = $user->getFollowedBy( isset( $_GET['followers_cursor'] ) ? array( 'cursor' => $_GET['followers_cursor'] ) : null );
$liked_media = $user->getLikedMedia( isset( $_GET['max_like_id'] ) ? array( 'max_like_id' => $_GET['max_like_id'] ) : null );
$feed = $user->getFeed( isset( $_GET['max_feed_id'] ) ? array( 'max_id' => $_GET['max_feed_id'] ) : null );

require( '_header.php' );
?>
<h2>Currently Logged In User</h2>

<h3><?php echo $user ?></h3>
<img src="<?php echo $user->getProfilePicture() ?>">

<a name="recent_media"></a>
<h4>Recent Media (<?php echo $user->getMediaCount() ?>) <?php if( $media->getNextMaxId() ): ?><a href="?example=current_user.php&max_id=<?php echo $media->getNextMaxId() ?>#recent_media" class="next_page">Next page</a><?php endif; ?></h4>
<ul class="media_list">
<?php foreach( $media as $m ): ?>
<li><a href="?example=media.php&media=<?php echo $m->getId() ?>"><img src="<?php echo $m->getThumbnail()->url ?>"></a></li>
<?php endforeach; ?>
</ul>

<a name="follows"></a>
<h4>Follows (<?php echo $user->getFollowsCount() ?>) <?php if( $follows->getNextCursor() ): ?><a href="?example=current_user.php&follows_cursor=<?php echo $follows->getNextCursor() ?>#follows" class="next_page">Next page</a><?php endif; ?></h4>
<ul class="media_list">
<?php foreach( $follows as $follow ): ?>
<li><a href="?example=user.php&user=<?php echo $follow->getId() ?>"><img src="<?php echo $follow->getProfilePicture() ?>" title="<?php echo $follow ?>"></a></li>
<?php endforeach; ?>
</ul>

<a name="followers"></a>
<h4>Followers (<?php echo $user->getFollowedByCount() ?>) <?php if( $followers->getNextCursor() ): ?><a href="?example=current_user.php&followers_cursor=<?php echo $followers->getNextCursor() ?>#followers" class="next_page">Next page</a><?php endif; ?></h4>
<ul class="media_list">
<?php foreach( $followers as $follower ): ?>
<li><a href="?example=user.php&user=<?php echo $follower->getId() ?>"><img src="<?php echo $follower->getProfilePicture() ?>" title="<?php echo $follower ?>"></a></li>
<?php endforeach; ?>
</ul>

<a name="liked_media"></a>
<h4>Liked Media <?php if( $liked_media->getNextMaxLikeId() ): ?> <a href="?example=current_user.php&max_like_id=<?php echo $liked_media->getNextMaxLikeId() ?>#liked_media" class="next_page">Next page</a><?php endif; ?></h4>
<ul class="media_list">
<?php foreach( $liked_media as $liked_m ): ?>
<li><a href="?example=media.php&media=<?php echo $liked_m->getId() ?>"><img src="<?php echo $liked_m->getThumbnail()->url ?>"></a></li>
<?php endforeach; ?>
</ul>

<a name="feed"></a>
<h4>Feed <?php if( $feed->getNextMaxId() ): ?> <a href="?example=current_user.php&max_feed_id=<?php echo $feed->getNextMaxId() ?>#feed" class="next_page">Next page</a><?php endif; ?></h4>
<ul class="media_list">
<?php foreach( $feed as $f ): ?>
<li><a href="?example=media.php&media=<?php echo $f->getId() ?>"><img src="<?php echo $f->getThumbnail()->url ?>" title="Posted by <?php echo $f->getUser() ?>"></a></li>
<?php endforeach; ?>
</ul>

<?php require( '_footer.php' ); ?>
<form method="post" id="likedislike_[[+like.id]]" class="likedislike mini_likedislik[[+like.class]]" name="mini_likedislik">
    <input type="hidden" name="likedislike_id" value="[[+like.id]]" />
	<input type="hidden" name="likedislike_format" value="[[+like.format]]" />

	<strong class="result1 error">[[+like.result_up]]</strong>

	<input class="up"   name="likedislike_vote" type="submit" value="+1" title="Vote up" [[+like.disabled]] />
	<input class="down" name="likedislike_vote" type="submit" value="-1" title="Vote down" [[+like.disabled]] />
</form>
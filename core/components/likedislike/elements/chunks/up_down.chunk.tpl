<form method="post" id="likedislike_[[+like.id]]" class="likedislike up_down[[+like.class]]" name="up_down">
    <input type="hidden" name="likedislike_id" value="[[+like.id]]" />
	<input type="hidden" name="likedislike_format" value="[[+like.format]]" />
    <input type="hidden" name="likedislike_round" value="[[+like.round]]" />

	<strong class="result1 error[[+like.squeeze]]">[[+like.result_up]]</strong>

	<input class="up"   name="likedislike_vote" type="submit" value="+1" title="Vote up"   [[+like.disabled]] />
	<input class="down" name="likedislike_vote" type="submit" value="-1" title="Vote down" [[+like.disabled]] />
</form>
<form method="post" id="likedislike_[[+like.id]]" class="likedislike likedislik_up_down[[+like.class]]" name="likedislik_up_down">
    <input type="hidden" name="likedislike_id" value="[[+like.id]]" />
	<input type="hidden" name="likedislike_format" value="[[+like.format]]" />

	<strong class="result1 error[[+like.squeeze]]" title="Votes up">[[+like.result_up]]</strong>
	<strong class="result2 error[[+like.squeeze]]" title="Votes down">[[+like.result_down]]</strong>

	<input class="up"   name="likedislike_vote" type="submit" value="+1" title="Vote up"   [[+like.disabled]] />
	<input class="down" name="likedislike_vote" type="submit" value="-1" title="Vote down" [[+like.disabled]] />
    
    <strong class="likeclose">[[%likedislike.voting_closed]]</strong>
    <strong class="likethanks">[[%likedislike.thanks_vote]]</strong>
</form>
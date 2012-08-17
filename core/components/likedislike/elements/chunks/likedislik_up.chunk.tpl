<form method="post" id="likedislike_[[+like.id]]" class="likedislike likedislik_up[[+like.class]]" name="likedislik_up">
    <input type="hidden" name="likedislike_id" value="[[+like.id]]" />
	<input type="hidden" name="likedislike_format" value="[[+like.format]]" />
    <input type="hidden" name="likedislike_round" value="[[+like.round]]" />

	<strong class="result1 error[[+like.squeeze]]">[[+like.result_up]]</strong>
    <strong class="likename">[[%likedislike.like]]</strong>   

	<input type="submit" name="likedislike_vote" value="+1" [[+like.disabled]] />
    
    <strong class="likeclose">[[%likedislike.voting_closed]]</strong>
    <strong class="likethanks">[[%likedislike.thanks_vote]]</strong>
</form>
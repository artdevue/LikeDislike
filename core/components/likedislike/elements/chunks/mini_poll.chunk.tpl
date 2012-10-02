<form method="post" id="likedislike_[[+like.id]]" class="likedislike mini_poll[[+like.class]]" name="mini_poll">
    <input type="hidden" name="likedislike_id" value="[[+like.id]]" />
	<input type="hidden" name="likedislike_format" value="[[+like.format]]" />
    <input type="hidden" name="likedislike_round" value="[[+like.round]]" />
    <input type="hidden" name="likedislike_rating" value="[[+like.rating]]" />

	<span class="graph up"   style="width:[[+like.votes_pct_up]]%;   background-color:[[+like.color_up]]"></span>
	<span class="graph down" style="width:[[+like.votes_pct_down]]%; background-color:[[+like.color_down]]"></span>

	<label class="option_up" for="likedislike_[[+like.id]]_up">
		<input id="likedislike_[[+like.id]]_up" type="radio" name="likedislike_vote" value="+1" />
		[[+like.up]]
		<strong class="result1 error">[[+like.result_up]]</strong>
	</label>

	<label class="option_down" for="likedislike_[[+like.id]]_down">
		<input id="likedislike_[[+like.id]]_down" type="radio" name="likedislike_vote" value="-1" />
		[[+like.down]]
		<strong class="result2 error">[[+like.result_down]]</strong>
	</label>

	<input type="submit" value="Vote" [[+like.disabled]] />
</form>

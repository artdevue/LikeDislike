<form method="post" id="likedislike_[[+like.id]]" class="likedislike buttons[[+like.class]]" name="buttons">
    <input type="hidden" name="likedislike_id" value="[[+like.id]]" />
	<input type="hidden" name="likedislike_format" value="[[+like.format]]" />
    <input type="hidden" name="likedislike_round" value="[[+like.round]]" />
    <input type="hidden" name="likedislike_rating" value="[[+like.rating]]" />

	<span class="result1 error">[[+like.result_up]] [[like.question]]</span>
	<span class="question">[[+like.question]]</span>

	<button class="up"   name="likedislike_vote" value="+1" [[+like.disabled]]>[[+like.up]]</button>
	<button class="down" name="likedislike_vote" value="-1" [[+like.disabled]]>[[+like.down]]</button>
</form>
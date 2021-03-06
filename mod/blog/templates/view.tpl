
<div class="hentry box blog-list-view">
    <div class="box-title">
        <h2 class="entry-title">{TITLE} <!-- BEGIN unpub --><span
                class="unpublished"
                >({UNPUBLISHED})</span><!-- END unpub --></h2>
        <h3 class="posted-by">{POSTED_BY} <abbr class="author">{AUTHOR}</abbr></h3>
        <h3 class="posted-on">{POSTED_ON} <abbr class="published"
                                                title="{PUBLISHED_DATE}"
                                                >{LOCAL_DATE}</abbr></h3>
    </div>
    <div class="box-content">
        <div class="entry-summary"><!-- BEGIN image -->
            <div class="entry-image">{IMAGE}</div>
            <!-- END image -->{SUMMARY}</div>
        <!-- BEGIN comment-info -->
        <div class="read-more"><!-- BEGIN read-more -->{READ_MORE}<!-- END read-more -->
            {SEPARATOR} <!-- BEGIN last-poster -->-
            {LAST_POSTER_LABEL}: {LAST_POSTER}<!-- END last-poster --></div>
        <!-- BEGIN edit-link -->
        <div class="blog-edit">{EDIT_LINK}</div>
        <!-- END edit-link --> <!-- END comment-info --></div>
</div>

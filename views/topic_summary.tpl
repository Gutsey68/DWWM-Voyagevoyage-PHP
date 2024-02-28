{* La view d'un résumé d'un topic du forum *}

<div class="col-12 resume-topic">
    <div class="card mb-3">
        <a class="text-decoration-none green-title shadow" href="forum/topic?id={$objForum->getId()}">
            <div class="card-header">
                {$objForum->getCreator()}
            </div>
            <div class="card-body">
                <h3 class="card-title">{$objForum->getTitle()}</h3>
                <p class="card-text">
                    {if ($strPage == "index")}
                        {$objForum->getContentSummary(UtripCtrl::MAX_CONTENT)}
                    {else}
                        {$objForum->getContentSummary(ForumCtrl::MAX_CONTENT)}
                    {/if}
                </p>
            </div>
        </a>
    </div>
</div>
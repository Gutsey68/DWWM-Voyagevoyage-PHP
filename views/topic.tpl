{* La view d'un résumé d'un topic du forum *}

<div class="col-12 resume-topic mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            {$objForum->getCreator()}
        </div>
        <div class="card-body">
            <h3 class="card-title">{$objForum->getTitle()}</h3>
            <p class="card-text">{$objForum->getContent()}</p>
        </div>
    </div>
</div>
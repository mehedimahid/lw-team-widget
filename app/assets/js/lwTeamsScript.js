jQuery(document).ready(function($){
    function loadTeams(page = 1){
        $.ajax({
            url: lwTeamsAjax.ajaxurl,
            type: "POST",
            data: {
                action: "lw_load_teams",
                nonce: lwTeamsAjax.nonce,
                page: page,
                posts_per_page: lwTeamsAjax.posts_per_page,
                posts_per_column: lwTeamsAjax.posts_per_column,
                posts_switch: lwTeamsAjax.posts_switch,
                current_page_id: lwTeamsAjax.current_page_id,
            },
            beforeSend:function (){
                $(".lw-teams-container").addClass('loading')
                if($(".lw-loader").length === 0){
                    $(".lw-teams-container").append('<div class="lw-loader">Loading...</div>');
                }
            },
            success: function(response){
                if(response.success){
                    $(".lw-teams-container").html(response.data.html);
                    $(".lw-pagination").html(response.data.pagination);
                }
            },
            complete: function (){
                $(".lw-teams-container").removeClass('loading')
                $(".lw-loader").remove()
            }
        });
    }
    // Handle pagination click
    $('.lw-pagination').on("click", "a", function(e){
        e.preventDefault();
        let url = $(this).attr("href");
        let page = url.match(/page\/(\d+)/);
        if (page) {
            page = page ? page[1] : 1;
            loadTeams(page);
        }
    });
});

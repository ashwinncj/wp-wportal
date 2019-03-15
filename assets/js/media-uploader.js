var media_uploader = null;

function open_media_uploader_image() {
    media_uploader = wp.media({
        frame: "post",
        state: "insert",
        multiple: false
    });

    media_uploader.on("insert", function () {
        var json = media_uploader.state().get("selection").first().toJSON();

        var image_url = json.url;
        var image_caption = json.caption;
        var image_title = json.title;
        //console.log(image_url);
        media = {
            url: image_url,
            caption: image_caption,
            image_title: image_title
        };
        return media;
    });

    media_uploader.open();
}
function open_media_uploader_multiple_images() {
    media_uploader = wp.media({
        frame: "post",
        state: "insert",
        multiple: true
    });

    media_uploader.on("insert", function () {

        var length = media_uploader.state().get("selection").length;
        var images = media_uploader.state().get("selection").models;
        var image_urls = {};
        for (var iii = 0; iii < length; iii++)
        {
            var image_url = images[iii].changed.url;
            var image_caption = images[iii].changed.caption;
            var image_title = images[iii].changed.title;
            image_urls[iii] = {
                url: image_url,
                caption: image_caption,
                image_title: image_title
            };
        }
        return(image_urls);
    });

    media_uploader.open();
}
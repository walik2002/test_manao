class AjaxRequester {
    constructor(url) {
        this.url = url;
    }

    post(formData, successCallback, errorCallback) {
        $.ajax({
            url: this.url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: successCallback,
            error: errorCallback
        });
    }

    get(successCallback, errorCallback) {
        $.ajax({
            url: this.url,
            type: "GET",
            success: successCallback,
            error: errorCallback
        });
    }
}

export default AjaxRequester;
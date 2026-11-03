el = function (el) {
    return document.getElementById(el);
};

getAwsUrl = function (key) {
    return `https://bucket-poisson-2025.s3.ap-southeast-1.amazonaws.com//${key}`;
};

uploadFiles = function (id, folder, team_id) {
    let file = el(id).files[0];

    if (!file) throw "Harap Isi File Anda";

    let awsUrl;

    return fetch("/api/presigned-aws", {
        method: "POST",
        body: JSON.stringify({
            filename: file.name,
            folder: folder,
            team_id: team_id,
        }),
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((res) => {
            if (!res.ok) throw "Gagal Mengupload File";
            return res.json();
        })
        .then((data) => {
            const url = data.url.action;

            const formData = new FormData();
            Object.entries(data.fields).forEach(([k, v]) => {
                if (k !== "acl") {
                    formData.append(k, v);
                }
            });
            formData.append("file", file);

            awsUrl = data.fields.key;

            return fetch(url, {
                method: "POST",
                body: formData,
            }).then((res) => {
                if (!res.ok) throw "Gagal Mengupload File";
                return res;
            });
        })
        .then(() => getAwsUrl(awsUrl));
};

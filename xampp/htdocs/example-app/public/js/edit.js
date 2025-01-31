const fileSelect = document.getElementById("file-select-btn");
        const fileElem = document.getElementById("student-img");

        fileSelect.addEventListener("click", (e) => {
            if (fileElem) {
                fileElem.click();
            }
        }, false);

        // ファイル変更
        function fileChange() {
            const registedImgElem = document.getElementById("registered-img");
            const fileNameElem = document.getElementById("file-name");
            const fileElem = document.getElementById("student-img");
            const fileChangeFlgElem = document.getElementById("file-change-flg");

            // 登録済み画像を非表示にする
            if (registedImgElem) {
                registedImgElem.style.display = "none";
            }
            // ファイル名を表示
            fileNameElem.textContent = getFileName(fileElem.value);
            // ファイル変更フラグを1(変更あり)にする
            fileChangeFlgElem.value = "1";
        }

        // ファイル名取得
        function getFileName(filePath) {
            // スラッシュまたはバックスラッシュの後の部分を取得
            const match = filePath.match(/[^\\/]+$/);
            return match ? match[0] : '';
        }
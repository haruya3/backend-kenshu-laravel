function onChangeLoadedImage(image, uplodingInputId, maxFileSizeOnUpload)
{
    const selectedFiles = image.files;
    const previewBlock = document.getElementById('preview');

    if (selectedFiles.length === 0) {
        displayErrorMessageAboutNotSelectedFile(previewBlock);
    }else{
        const resetPreviewElements = resetPreview(previewBlock);
        const list = document.createElement('ol');
        previewBlock.appendChild(list);

        for(const [index, selectedFile] of Object.entries(selectedFiles)){
            if(selectedFile.size > maxFileSizeOnUpload){
                displayErrorMessageAboutFileSizeOver();
                document.getElementById(uplodingInputId).value = '';
                //選択されていた画像を再度表示する
                resetPreviewElements.forEach(resetPreviewElement => previewBlock.appendChild(resetPreviewElement));
                return;
            }
            list.appendChild(createPreviewElelement(index, selectedFile));
        }
    }
}

function onInputPassword(passwordInputElement)
{
    document.getElementById('display-password').textContent = passwordInputElement.value;
}

function onClickHiddenButton()
{
    document.getElementById('display-password').style.visibility = document.getElementById('display-password').style.visibility === 'hidden' ? 'visible' : 'hidden';
}

function resetPreview(previewBlock)
{
    const resetPreviewElements = []
    while(previewBlock.firstChild){
        resetPreviewElements.push(previewBlock.firstChild);
        previewBlock.removeChild(previewBlock.firstChild);
    }

    return resetPreviewElements;
}


function createPreviewElelement(index, selectedFile)
{
    const listItem = document.createElement('li');
    const fileNameElement = document.createElement('p');

    if(index === '0'){
        fileNameElement.textContent = 'サムネイル画像 ' + 'ファイル名: ' + selectedFile.name;
    }else{
        fileNameElement.textContent = 'ファイル名: ' + selectedFile.name;
    }
    const selectedImagePreviewElement = document.createElement('img');

    selectedImagePreviewElement.setAttribute('alt', 'preview');
    selectedImagePreviewElement.setAttribute('style', 'object-fit: contain;');
    selectedImagePreviewElement.setAttribute('width', '200');
    selectedImagePreviewElement.setAttribute('height', '200');
    selectedImagePreviewElement.src = URL.createObjectURL(selectedFile);

    listItem.appendChild(fileNameElement);
    listItem.appendChild(selectedImagePreviewElement);

    return listItem;
}

function displayErrorMessageAboutNotSelectedFile(previewBlock)
{
    const attentionElement = document.createElement('p');
    attentionElement.textContent = '最低一枚はサムネイル用に画像を選択してください';
    previewBlock.appendChild(attentionElement);
}

function displayErrorMessageAboutFileSizeOver()
{
    const errorBlock = document.getElementById('error-block');
    const errorMessageElelent =document.createElement('p');
    errorMessageElelent.textContent = 'ファイルサイズが大きすぎます。2MBまでの画像に変えてください。'
    errorMessageElelent.style.color = 'red';
    errorBlock.appendChild(errorMessageElelent);
}

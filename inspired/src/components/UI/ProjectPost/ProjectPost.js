import React, { useRef, useState } from 'react'
import axios from 'axios'
function ProjectPost() {
    const imgUpload = useRef(null)
    const [img, setImage] = useState('')

    const updateItem = () => {
        if (imgUpload.current.files.length > 0) {

            var formData = new FormData();
            let file = imgUpload.current.files[0];

            formData.append('file', file);
            formData.append('title', file.name);
            formData.append('post', itemid); //coming from props

            let headers = {};
            headers['Content-Disposition'] = 'form-data; filename=\'' + file.name + '\'';
            headers['X-WP-Nonce'] = 'your nonce here...';

            axios.post('/wp-json/wp/v2/media/?featured=' + itemid, formData, headers).then(function (resp) {
                getItems(); //callback to parent's this.getItems(), 
            })
        }
    }
    return (
        <div>

            <input id="imgUpload" type="file" ref={imgUpload} onChange={previewImage} />
            <button onClick={updateItem}>Update</button>
        </div>
    )
}

export default ProjectPost

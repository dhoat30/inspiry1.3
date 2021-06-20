import React from 'react'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCheckSquare, faCoffee } from '@fortawesome/pro-light-svg-icons'
function Search() {
    return (
        <div>

            <FontAwesomeIcon icon={faCoffee} />
            <input type='text' name="search" id="header-search" placeholder="Search" />
        </div>
    )
}

export default Search

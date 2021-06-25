import React, { useState } from 'react'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faSearch } from '@fortawesome/pro-light-svg-icons'
import * as styles from './Search.module.css'
function Search() {

    return (
        <div className={styles.searchContainer}>

            <FontAwesomeIcon icon={faSearch} />
            <input type='text' name="search" id="header-search" placeholder="Search" />
        </div>
    )
}

export default Search

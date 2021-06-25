import React, { useState } from "react"
import Logo from '../UI/Logo/Logo'
import * as styles from './Header.module.css'
import Search from '../UI/Search/Search'
import Navbar from '../Navbar/Navbar'
import { useMediaQuery } from 'react-responsive'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faSearch } from '@fortawesome/pro-light-svg-icons'
import Backdrop from "../UI/Backdrop/Backdrop"

const Header = ({ siteTitle }) => {
  const isMobile = useMediaQuery({ query: '(min-width: 600px)' })
  const [showSearchBar, setSearchBar] = useState(false)
  // backdrop handler
  const backdropHandler = () => {
    setSearchBar(false)
  }
  // magnifying click handler
  const clickHandler = () => {
    setSearchBar(true)
  }

  return (
    <section className={`${styles.headerSection} row-container `}>
      <div className={styles.logoContainer} >
        <Logo showIcon={true} elementWidth={200}></Logo>

      </div>

      <div className={styles.searchContainer} >
        {showSearchBar ? <Backdrop show={showSearchBar} clicked={backdropHandler} /> : null}
        {showSearchBar || isMobile ? <Search /> : <FontAwesomeIcon icon={faSearch} onClick={clickHandler} />
        }
      </div>

      <div className={`${styles.navbarContainer}`}>
        <Navbar mobileScreen={isMobile} />
      </div>
    </section>
  )
}


export default Header

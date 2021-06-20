import * as React from "react"
import Logo from '../../UI/Logo/Logo'
import * as styles from './Header.module.css'
import Search from '../../UI/Search/Search'

const Header = ({ siteTitle }) => {
  return (
    <section className={`${styles.headerSection} row-container`}>
      <Logo showIcon={true}></Logo>
      <Search />
    </section>
  )
}


export default Header

/**
 * Layout component that queries for data
 * with Gatsby's useStaticQuery component
 *
 * See: https://www.gatsbyjs.com/docs/use-static-query/
 */

import * as React from "react"
import PropTypes from "prop-types"
import { useStaticQuery, graphql } from "gatsby"

import Header from "./Header/Header"
import "./layout.css"

import { AuthContextProvider } from "../store/auth-context"
import { MenuContextProvider } from "../store/menu-context"

const Layout = ({ children }) => {
  const data = useStaticQuery(graphql`
    query SiteTitleQuery {
      site {
        siteMetadata {
          title
        }
      }
    }
  `)

  return (
    <AuthContextProvider>
      <MenuContextProvider>
        <Header siteTitle={data.site.siteMetadata?.title || `Title`} />
        <div>
          <main className="main">
            {children}
          </main>

        </div>
      </MenuContextProvider>
    </AuthContextProvider>
  )
}

Layout.propTypes = {
  children: PropTypes.node.isRequired,
}

export default Layout

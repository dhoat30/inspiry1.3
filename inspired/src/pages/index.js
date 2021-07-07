import * as React from "react"
import { Link } from "gatsby"

import Layout from "../components/layout"
import Seo from "../components/seo"
import HomePage from "../components/HomePage/HomePage"
const IndexPage = () => (
  <Layout>
    <Seo title="Home" />

    <HomePage />

  </Layout>
)

export default IndexPage

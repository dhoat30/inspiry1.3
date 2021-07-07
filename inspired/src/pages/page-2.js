import * as React from "react"
import { Link } from "gatsby"

import Layout from "../components/layout"
import Seo from "../components/seo"
import ProjectPost from "../components/UI/ProjectPost/ProjectPost"

const SecondPage = () => (
  <Layout>
    <Seo title="Page two" />

    <ProjectPost />
  </Layout>
)

export default SecondPage

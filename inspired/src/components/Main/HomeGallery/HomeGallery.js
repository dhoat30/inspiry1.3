import React from 'react'
import { graphql, useStaticQuery } from 'gatsby'

import Card from '../..//UI/Cards/Card/Card'
import * as styles from './HomeGallery.module.css';
import RegisterModal from '../../UI/RegisterModal/RegisterModal';
const queryFirst = graphql`
{
    firstQuery: allWpGdProjects( limit: 10) {
      edges {
        node {
          id
          title
          featuredImage {
            node {
              localFile {
                childImageSharp {
                  gatsbyImageData(
                    height: 350
                    width: 250
                    layout: FIXED
                    placeholder: BLURRED
                  )
                }
              }
            }
          }
        }
      }
    }
    secondQuery: allWpGdProjects(limit: 10, skip: 10) {
        edges {
          node {
            id
            title
            featuredImage {
              node {
                localFile {
                  childImageSharp {
                    gatsbyImageData(
                      height: 350
                      width: 250
                      layout: FIXED
                      placeholder: BLURRED
                    )
                  }
                }
              }
            }
          }
        }
      }
      thirdQuery: allWpGdProjects(limit: 10, skip: 20) {
        edges {
          node {
            id
            title
            featuredImage {
              node {
                localFile {
                  childImageSharp {
                    gatsbyImageData(
                      height: 350
                      width: 250
                      layout: FIXED
                      placeholder: BLURRED
                    )
                  }
                }
              }
            }
          }
        }
      }
      fourthQuery: allWpGdProjects(limit: 10, skip: 30) {
        edges {
          node {
            id
            title
            featuredImage {
              node {
                localFile {
                  childImageSharp {
                    gatsbyImageData(
                      height: 350
                      width: 250
                      layout: FIXED
                      placeholder: BLURRED
                    )
                  }
                }
              }
            }
          }
        }
      }
      fifthQuery: allWpGdProjects(limit: 10, skip: 40) {
        edges {
          node {
            id
            title
            featuredImage {
              node {
                localFile {
                  childImageSharp {
                    gatsbyImageData(
                      height: 350
                      width: 250
                      layout: FIXED
                      placeholder: BLURRED
                    )
                  }
                }
              }
            }
          }
        }
      }
      sixthQuery: allWpGdProjects(limit: 10, skip: 50) {
        edges {
          node {
            id
            title
            featuredImage {
              node {
                localFile {
                  childImageSharp {
                    gatsbyImageData(
                      height: 350
                      width: 250
                      layout: FIXED
                      placeholder: BLURRED
                    )
                  }
                }
              }
            }
          }
        }
      }
  }
`

function HomeGallery() {
  const data = useStaticQuery(queryFirst)
  // const secondData = useStaticQuery(querySecond)
  return (
    <React.Fragment>

      <RegisterModal />
      <div className={`flex-row justify-center ${styles.galleryContainer}`}>

        <Card queryData={data.firstQuery} flex="flex-column" justify="justify-center" />
        <Card queryData={data.secondQuery} />
        <Card queryData={data.thirdQuery} />
        <Card queryData={data.fourthQuery} />
        <Card queryData={data.fifthQuery} />
        <Card queryData={data.sixthQuery} />

      </div>
    </React.Fragment>
  )
}

export default HomeGallery

import React from 'react'
import * as styles from './MercCards.module.css'
import { graphql, useStaticQuery } from 'gatsby'
import Card from '../../UI/Cards/Card/Card'
const queryFirst = graphql`
{
    firstQuery: allWpGdProjects {
      edges {
        node {
          id
          title
          featuredImage {
            node {
              localFile {
                childImageSharp {
                  gatsbyImageData(
                
                    width: 300
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

const MercCards = () => {
  const data = useStaticQuery(queryFirst)

  // const secondData = useStaticQuery(querySecond)
  return (
    <React.Fragment>


      <div className={`${styles.mercCardsContainer}`}>
        <Card queryData={data.firstQuery} />
      </div>

    </React.Fragment>
  )
}

export default MercCards

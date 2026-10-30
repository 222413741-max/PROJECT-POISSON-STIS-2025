import React, { useContext } from 'react'
import styled from 'styled-components'
import tw from 'twin.macro'
import Context from '../helpers/Context'

import { SectionHeading } from './misc/Headings'
import { ContentWithPaddingXl } from './misc/Layouts'
import { PrimaryButton } from './misc/Buttons'

// import { ReactComponent as SvgDecoratorCubeLeft } from "images/svg-decorator-cube-left.svg";
// import { ReactComponent as SvgDecoratorCubeRight } from "images/svg-decorator-cube-right.svg";
import SvgDecoratorCubeLeft from './svgJSX/SvgDecoratorCubeLeft'
import SvgDecoratorCubeRight from './svgJSX/SvgDecoratorCubeRight'

// Styled Component
const Container = tw.div`relative`

const HeadingWrapper = tw.div`w-full text-center`

const Heading = tw(
  SectionHeading,
)`mb-20 tracking-wide uppercase relative inline-block`

const Column = tw.div`flex flex-wrap justify-center`

const CardColumn = tw.div`xl:mx-4 w-full md:w-1/2 xl:w-1/3 mt-16 xl:mt-0`

const Card = tw.div`mx-auto max-w-sm md:max-w-xs lg:max-w-sm xl:max-w-xs`

const CardImage = styled.div((props) => [
  `background-image: url("${props.imageSrc}");`,
  tw`h-56 w-56 mx-auto md:w-auto md:h-80 bg-cover bg-center rounded`,
])

const CardText = tw.div`flex flex-col justify-between mt-4 gap-8`

const CardTitle = tw.h5`text-center text-4xl mt-4 font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange to-purple z-10`

const CardDescription = tw.div`text-center text-white tracking-wide text-base px-5 z-10`

const CardBtnWrapper = tw.div`w-full text-center z-10`

const CardBtn = tw(PrimaryButton)`py-2`

const DecoratorCubeLeft = styled(SvgDecoratorCubeLeft)`
  ${tw`pointer-events-none z-0 absolute left-0 top-1/2 w-40 h-40 md:h-[450px] md:w-[450px] transform translate-x-[-4rem] -translate-y-2/3`}
`

const DecoratorCubeRight = styled(SvgDecoratorCubeRight)`
  ${tw`pointer-events-none z-10 absolute right-0 top-1/2 w-40 h-40 md:h-[450px] md:w-[450px] transform translate-x-[4rem] translate-y-[25rem] md:translate-y-1/2`}
`

// Component
const Lomba = () => {
  const { lomba } = useContext(Context)
  return (
    <Container id="lomba">
      <ContentWithPaddingXl>
        <HeadingWrapper>
          <Heading bottomLine={true}>Perlombaan</Heading>
        </HeadingWrapper>
        <DecoratorCubeLeft />
        <Column>
          {lomba.map((card, index) => (
            <CardColumn key={index}>
              <Card>
                <div style={{ position: 'relative' }}>
                  <CardImage imageSrc={card.imageSrc} />
                  {/* <DotPattern/> */}
                </div>
                <CardText>
                  <CardTitle>{card.title}</CardTitle>
                  <CardDescription>{card.description}</CardDescription>
                  <CardBtnWrapper>
                    <CardBtn as="a" href={card.link}>
                      Buku Panduan
                    </CardBtn>
                  </CardBtnWrapper>
                </CardText>
              </Card>
            </CardColumn>
          ))}
        </Column>
        <DecoratorCubeRight />
      </ContentWithPaddingXl>
    </Container>
  )
}

export default Lomba

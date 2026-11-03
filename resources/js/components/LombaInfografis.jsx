import React from 'react'
import tw from 'twin.macro'
import styled from 'styled-components'
// import * as Icon from "react-feather";

// import infografisImg from "images/infografis.png";
import { infografisImg } from '../config'
import { SectionHeading } from './misc/Headings'
import { PrimaryButton as PrimaryButtonBase } from './misc/Buttons'
// import { ReactComponent as MoneyIcon } from "feather-icons/dist/icons/dollar-sign.svg";
// import { ReactComponent as SvgDotPattern } from "images/dot-pattern.svg";
import SvgDotPattern from './svgJSX/DotPattern'
// import { ReactComponent as SvgDecoratorBlob } from "images/svg-decorator-blob-1.svg";
import SvgSvgDecoratorBlob1 from './svgJSX/SvgDecoratorBlob1'

// const MoneyIcon = Icon.DollarSign;
const SvgDecoratorBlob = SvgSvgDecoratorBlob1

// Styled Component
const Container = tw.div`relative`

const TwoColumn = tw.div`flex flex-col md:flex-row justify-between max-w-screen-xl mx-auto py-20 md:py-24 px-4`

const Column = tw.div`w-full max-w-md mx-auto md:max-w-none md:mx-0`

const ImageColumn = tw(Column)`relative md:w-5/12 flex-shrink-0 h-80 md:h-auto`

const TextColumn = tw(
  Column,
)`md:w-7/12 mt-8 md:mt-0 md:mr-12 lg:mr-16 md:order-first`

const Image = styled.div((props) => [
  `background-image: url("${props.imageSrc}");`,
  tw`rounded bg-contain bg-no-repeat bg-center h-full`,
])

const DotPattern = styled(SvgDotPattern)(() => [
  tw`w-20 h-20 absolute right-0 bottom-0 transform translate-x-1/2 translate-y-1/2 fill-current text-orange-600 -z-10`,
])

const TextContent = tw.div`lg:py-8 text-center md:text-left`

const Heading = tw(
  SectionHeading,
)`mt-4 font-black text-left text-3xl sm:text-4xl lg:text-5xl text-left leading-tight`

const Description = tw.p`mt-4 text-left text-sm md:text-base lg:text-lg font-medium leading-relaxed text-secondary-800`

const Prizes = tw.div`mt-8 max-w-sm mx-auto md:mx-0`

const Prize = tw.div`mt-8 flex items-center flex-row`

const PrizeText = tw.div`mt-0 ml-4 text-left flex-1`

const PrizeHeading = tw.div`font-bold text-lg text-orange-600`

const PrimaryButton = tw(
  PrimaryButtonBase,
)`mt-8 md:mt-10 text-sm inline-block mx-auto md:mx-0`

const DecoratorBlob = styled(SvgDecoratorBlob)`
  ${tw`pointer-events-none -z-20 absolute right-0 bottom-0 h-96 w-96 transform translate-x-2/3 -translate-y-12 text-orange-600`}
`

// Component
export default () => {
  const features = [
    // {
    //   Icon: MoneyIcon,
    //   title: "Rp 1.000.000",
    // },
    // {
    //   Icon: MoneyIcon,
    //   title: "Rp 1.000.000",
    // },
    // {
    //   Icon: MoneyIcon,
    //   title: "Rp 1.000.000",
    // },
  ]

  return (
    <Container>
      <TwoColumn>
        <ImageColumn>
          <Image imageSrc={infografisImg} />
          <DotPattern />
        </ImageColumn>
        <TextColumn>
          <TextContent>
            <Heading>
              Lomba <span tw="text-orange-600">STATISTICAL INFOGRAPHIC</span>
            </Heading>
            <Description>
              Menguji pemahaman dan penerapan statistika dalam kompetisi skala
              nasional
            </Description>
            <Prizes>
              {features.map((prize, index) => (
                <Prize key={index}>
                  {<prize.Icon />}
                  <PrizeText>
                    <PrizeHeading>{prize.title}</PrizeHeading>
                  </PrizeText>
                </Prize>
              ))}
            </Prizes>
            <PrimaryButton
              as="a"
              href="https://drive.google.com/file/d/1pSl6Emup0hEMGWC57GQeEOpPFU2Gbai6/view?usp=sharing"
            >
              GUIDEBOOK
            </PrimaryButton>
          </TextContent>
        </TextColumn>
      </TwoColumn>
      <DecoratorBlob />
    </Container>
  )
}

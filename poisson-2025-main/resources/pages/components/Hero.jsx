import React from 'react'
import styled from 'styled-components'
import tw from 'twin.macro'

import { SectionHeading } from './misc/Headings'
import { SectionDescription } from './misc/Typography'
import { PrimaryButton as PrimaryButtonBase } from './misc/Buttons'
import { Container, ContentWithVerticalPadding } from './misc/Layouts'

import SvgDecoratorRight from './svgJSX/DecorGradientRight'
import SvgDecoratorLeft from './svgJSX/DecorGradientLeft'

// Styled Component
const Column = tw.div``

const Row = tw.div`flex flex-col lg:flex-row justify-between items-center lg:pt-16 max-w-screen-2xl mx-auto sm:px-8`

const TextColumn = tw(Column)`mr-auto lg:mr-0 max-w-lg lg:max-w-xl xl:max-w-2xl`

const Heading = tw(SectionHeading)`text-left leading-snug xl:text-6xl`

const TagLine = tw(
  SectionDescription,
)`italic text-white tracking-wider mb-10 text-lg`

const Description = tw(
  SectionDescription,
)`mt-4 lg:text-base text-gray-300 max-w-2xl z-30`

const PrimaryButton = tw(
  PrimaryButtonBase,
)`mt-8 inline-block w-[250px] tracking-wide text-center`

const ImageColumn = tw(Column)`ml-auto lg:mr-0 relative mt-16 lg:mt-0 lg:ml-32`

const ImageContainer = tw.div`relative`

const Image = tw.img`max-w-full w-[500px] rounded-t sm:rounded relative z-0`

const DecoratorRight = styled(SvgDecoratorRight)`
  ${tw`pointer-events-none z-10 absolute right-[1px] bottom-0 h-96 w-96 transform -translate-y-1/2 translate-x-[8rem]`}
`

const DecoratorLeft = styled(SvgDecoratorLeft)`
  ${tw`pointer-events-none z-10 absolute left-[1px] bottom-0 h-96 w-96 transform -translate-y-1/2 translate-x-[-8rem]`}
`

// component
const Hero = () => {
  return (
    <>
      <Container>
        <ContentWithVerticalPadding>
          <DecoratorLeft />
          <Row>
            <TextColumn>
              <Heading>
                POISSON <wbr />
                <span tw="text-purple">2023</span>
              </Heading>
              <TagLine>Building the Future with Official Statistics</TagLine>
              <Description>
                POISSON atau Pekan Olimpiade dan Infografis Statistika Nasional
                merupakan kompetisi statistika tahunan tingkat nasional yang
                diselenggarakan oleh Unit Pendidikan dan Kebudayaan UKM Forum
                Informasi dan Kajian Statistik (Forkas) di bawah naungan Senat
                Mahasiswa Politeknik Statistika STIS. POISSON bertujuan untuk
                melatih kemampuan mahasiswa Indonesia untuk berpikir secara
                kritis dan rasional dalam memecahkan masalah terkini dengan
                menggunakan statistik, mengingat penggunaan statistik bukanlah
                hal yang baru di era saat ini. Khususnya pada POISSON 2023, para
                peserta yang berkompetisi juga akan memperebutkan piala bergilir
                sehingga akan membanggakan almamater kampus. Kegiatan POISSON
                terdiri dari dua jenis perlombaan, yaitu Statistics Olympiad dan
                Infografis Statistika. Kegiatan ini terbuka bagi mahasiswa/i
                program studi D3/D4/S1 semua jurusan yang berasal dari berbagai
                perguruan tinggi di Indonesia yang ingin mengembangkan dan
                mengasah kemampuan dalam menyelesaikan permasalahan terkait
                statistika serta menyajikan infografis yang menarik dan
                informatif.
              </Description>
              <PrimaryButton as="a" href="/login">
                Daftar
              </PrimaryButton>
            </TextColumn>
            <ImageColumn>
              <ImageContainer>
                <Image src="/img/landing-page/logo.svg" />
              </ImageContainer>
            </ImageColumn>
          </Row>
        </ContentWithVerticalPadding>
        <DecoratorRight />
      </Container>
    </>
  )
}

export default Hero

import React from "react";
import tw from "twin.macro";
import styled from "styled-components";

// import dnImg from "images/dn.png";
// import dnBg from "images/bg-dn.png";
import { dnImg, dnBg } from "../config";

import { PrimaryButton as PrimaryButtonBase } from "./misc/Buttons";
import {
  SectionHeading,
  Subheading as SubheadingBase,
} from "./misc/Headings";

// import { ReactComponent as SvgCubeLeft } from "images/svg-decorator-cube-left.svg";
import SvgCubeLeft from "./svgJSX/SvgDecoratorCubeLeft";

// Styled Component
const Container = styled.div((props) => [
  `background-image: url("${props.imageSrc}");`,
  tw`relative transform scale-x-105 bg-cover bg-no-repeat mt-[8rem]`,
]);

const Column = tw.div`w-full max-w-md mx-auto md:max-w-none md:mx-0`;

const TwoColumn = tw.div`flex flex-col-reverse md:flex-row-reverse justify-between max-w-screen-xl mx-auto py-20 md:py-24`;

const ImageColumn = tw(
  Column
)`md:w-5/12 flex justify-center md:justify-start items-center flex-shrink-0 h-80 md:h-auto relative md:order-last`;

const Image = styled.div((props) => [
  `background-image: url("${props.imageSrc}");`,
  tw`relative bg-cover bg-no-repeat w-56 h-56 md:w-96 md:h-96 z-20 lg:ml-20`,
]);

const TextColumn = tw(Column)`md:w-7/12 mt-16 md:mt-0 md:ml-12 md:px-8`;

const TextContent = tw.div`px-4 text-center md:text-left lg:-ml-10`;

const Subheading = tw(
  SubheadingBase
)`text-center md:text-left mt-3 mb-5 md:text-lg text-xs`;

const Heading = tw(
  SectionHeading
)`mt-4 font-black text-left text-xl sm:text-4xl lg:text-5xl text-center md:text-left leading-tight uppercase bg-clip-text text-transparent bg-gradient-to-r from-orange to-purple z-10`;

const Description = tw.p`mt-4 text-left text-xs md:text-base font-medium leading-relaxed text-white`;

const PrimaryButton = tw(
  PrimaryButtonBase
)`mt-8 inline-block w-[250px] tracking-wide text-center`;

const DecoratorCubeLeft = styled(SvgCubeLeft)`
  ${tw`pointer-events-none z-0 absolute left-0 w-40 h-40 md:h-[450px] md:w-[450px] transform translate-x-[-3rem] -translate-y-20 md:-translate-y-40`}
`;

// Component
const Dn = () => {
  return (
    <Container id="dn" imageSrc={dnBg}>
      <DecoratorCubeLeft />
      <TwoColumn>
        <TextColumn>
          <TextContent>
            <Heading>Dies Natalis</Heading>
            <Subheading>
              Merapah Cakrabuana, Arungi Pesona Budaya Nusantara
            </Subheading>
            <Description>
              Dies Natalis merupakan sebuah peringatan hari lahir suatu lembaga
              pendidikan. Dies Natalis juga dapat dimaknai sebagai bukti
              perjalanan karir lembaga tersebut. Dies Natalis Politeknik
              Statistika STIS ke-65 menjadi tanda bahwa keberadaannya yang
              sekarang berusia 65 tahun masih memiliki daya tarik di tengah
              persaingan yang semakin ketat di antara perguruan tinggi negeri,
              swasta, maupun kedinasan yang ada di Indonesia. Dies Natalis ke-65
              AIS/STIS/Politeknik Statistika STIS mengangkat tema “Merapah
              Cakrabuana, Arungi Pesona Budaya Nusantara”. Tema tersebut
              menggambarkan semangat untuk memahami, menjaga, dan menjelajahi
              keanekaragaman budaya Indonesia dengan menghargai warisan budaya
              yang ada dan mengeksplorasi keindahan budaya Nusantara.
            </Description>
            <PrimaryButton
              as="a"
              href="https://www.instagram.com/dn_polstatstis/"
            >
              Info Selengkapnya
            </PrimaryButton>
          </TextContent>
        </TextColumn>
        <ImageColumn>
          <Image imageSrc={dnImg} />
        </ImageColumn>
      </TwoColumn>
    </Container>
  );
};

export default Dn;

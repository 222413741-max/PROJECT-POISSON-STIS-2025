import React from "react";
import tw from "twin.macro";
import styled from "styled-components";

// Didefinisikan di config
// import semnasImg from "images/semnas.png";
// import semnasBg from "images/bg-semnas.png";
import { semnasImg, semnasBg } from "../config";

import { PrimaryButton as PrimaryButtonBase } from "./misc/Buttons";
import {
  SectionHeading,
  Subheading as SubheadingBase,
} from "./misc/Headings";

// Styled Component
const Container = styled.div((props) => [
  `background-image: url("${props.imageSrc}");`,
  tw`transform scale-x-125 bg-cover bg-no-repeat`,
]);

const Column = tw.div`w-full max-w-md mx-auto md:max-w-none md:mx-0`;

const TwoColumn = tw.div`flex flex-col md:flex-row justify-between max-w-screen-xl mx-auto py-20 md:py-24`;

const ImageColumn = tw(
  Column
)`md:w-5/12 flex justify-center md:justify-start items-center flex-shrink-0 h-80 md:h-auto relative md:order-last order-first`;

const Image = styled.div((props) => [
  `background-image: url("${props.imageSrc}");`,
  tw`relative bg-cover bg-no-repeat w-56 h-56 md:w-96 md:h-96 z-20`,
]);

const TextColumn = tw(
  Column
)`md:w-7/12 mt-16 md:mt-0 md:ml-12 lg:ml-16 md:px-8`;

const TextContent = tw.div`px-4 lg:py-8 text-center md:text-left`;

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

// Component
const Semnas = () => {
  return (
    <Container id="semnas" imageSrc={semnasBg}>
      <TwoColumn>
        <TextColumn>
          <TextContent>
            <Heading>Seminar Nasional.</Heading>
            <Subheading>
              Peran Official Statistics dan Sains Data dalam Mendukung Ketahanan
              Pangan
            </Subheading>
            <Description>
              Seminar Nasional (Semnas) Official Statistics merupakan seminar
              ilmiah rutin tahunan yang telah dilaksanakan oleh Politeknik
              Statistika STIS sejak tahun 2018. Tahun ini, POISSON kembali
              mendapatkan kesempatan untuk berkolaborasi bersama Semnas dalam
              salah satu kegiatannya. Tema yang diangkat dalam Seminar Nasional
              Official Statistics tahun ini adalah “Peran Official Statistics
              dan Sains Data dalam Mendukung Ketahanan Pangan”. Seminar ini
              bertujuan untuk menghasilkan pemikiran yang solutif terhadap
              berbagai tantangan di bidang official statistics dan isu-isu
              strategis nasional, serta karya-karya inovatif dan adaptif sebagai
              respons terhadap perkembangan teknologi informasi dan sains data.
              Rangkaian kegiatan Seminar Nasional Official Statistics diawali
              dengan Call For Paper, seminar paralel, dan seminar panel.
              Kegiatan ini dibuka untuk umum tanpa pungutan biaya apapun.
            </Description>
            <PrimaryButton as="a" href="https://semnas.stis.ac.id/">
              Info Selengkapnya
            </PrimaryButton>
          </TextContent>
        </TextColumn>
        <ImageColumn>
          <Image imageSrc={semnasImg} />
        </ImageColumn>
      </TwoColumn>
    </Container>
  );
};

export default Semnas;

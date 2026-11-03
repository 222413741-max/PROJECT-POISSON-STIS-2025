import React from "react";
import styled, { keyframes } from "styled-components";
import tw from "twin.macro";

import SvgDecoratorRight from "./svgJSX/DecorGradientRight";
import SvgDecoratorLeft from "./svgJSX/DecorGradientLeft";
import { Container, ContentWithVerticalPadding } from "./misc/Layouts";

// Animations
const fadeInUp = keyframes`
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
`;

// Styled Components
const FullHeightContainer = styled(Container)`
  ${tw`flex justify-center items-center h-screen relative overflow-hidden`}
  margin-top: 5vh; /* Mengurangi margin atas */
`;

const CenteredContent = styled.div`
  ${tw`text-center flex flex-col items-center relative`}
  z-index: 4; /* Mengatur z-index agar konten tetap berada di atas gambar */
  animation: ${fadeInUp} 1s ease-out both;

  @media (max-width: 768px) {
    padding-top: 1vh; /* Mengurangi padding atas pada tampilan mobile */
  }
`;

const ImageContainer = styled.div`
  ${tw`relative flex items-center justify-center`}
  width: 100%;
  height: 33vh;

  @media (max-width: 768px) {
    height: 20vh; /* Mengatur tinggi kontainer gambar pada tampilan mobile */
  }
`;

const Image = styled.img`
  ${tw`max-w-full`}
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 33vw;
  animation: ${fadeInUp} 1s ease-out both;

  @media (max-width: 768px) {
    width: 60vw; /* Mengatur lebar gambar pada tampilan mobile */
  }
`;

const Image1 = styled(Image)`
  ${tw`absolute left-0`}
  top: -10vh; /* Mengatur posisi gambar lebih tinggi */
  animation-delay: 0.5s;
`;

const Image2 = styled(Image)`
  ${tw`absolute left-0`}
  top: -5vh; /* Mengatur posisi gambar lebih tinggi */
  animation-delay: 1s;
`;

const Image3 = styled(Image)`
  ${tw`absolute left-0`}
  top: 0; /* Mengatur posisi gambar lebih tinggi */
  animation-delay: 1.5s;
`;

const Text = styled.div`
  ${tw`text-4xl lg:text-6xl font-bold text-gray-900 mt-4`}
  margin-top: 7vh; /* Mengurangi margin atas */
  animation: ${fadeInUp} 1s ease-out 2s both;

  @media (max-width: 768px) {
    margin-top: 2vh; /* Menyesuaikan margin atas pada tampilan mobile */
  }
`;

const TagLine = styled.p`
  ${tw`text-lg text-gray-700`}
  animation: ${fadeInUp} 1s ease-out 2.5s both;
`;

const DecoratorRight = styled(SvgDecoratorRight)`
  ${tw`pointer-events-none z-10 absolute right-[1px] bottom-0 h-96 w-96 transform -translate-y-1/2 translate-x-[8rem]`}
`;

const DecoratorLeft = styled(SvgDecoratorLeft)`
  ${tw`pointer-events-none z-10 absolute left-[1px] bottom-0 h-96 w-96 transform -translate-y-1/2 translate-x-[-8rem]`}
`;

// Component
const HeroComing = () => {
  return (
    <FullHeightContainer>
      <ContentWithVerticalPadding>
        <DecoratorLeft />
        <CenteredContent>
          <ImageContainer>
            <Image1 src="/img/landing-page/1.png" alt="Logo 1" style={{ zIndex: 0 }} />
            <Image2 src="/img/landing-page/2.png" alt="Logo 2" style={{ zIndex: 1 }} />
            <Image3 src="/img/landing-page/3.png" alt="Logo 3" style={{ zIndex: 2 }} />
          </ImageContainer>
          <Text>Coming Soon</Text>
          <TagLine>Stay tuned for something amazing!</TagLine>
        </CenteredContent>
        <DecoratorRight />
      </ContentWithVerticalPadding>
    </FullHeightContainer>
  );
};

export default HeroComing;

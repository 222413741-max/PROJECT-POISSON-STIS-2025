import React from "react";
import tw from "twin.macro";
import styled from "styled-components";

const StyledDiv = styled.div`
  ${tw`font-display text-secondary-500 p-8 overflow-hidden`}
  background-color: #fec3a1;
  background-image: radial-gradient(circle, #f0edd5, #fde2ad, #efaf87, #fec3a1, #f0edd5);

  @media (max-width: 768px) {
    ${tw`p-4`}
  }
`;

const AwanKuning = styled.img`
  ${tw`absolute`}
  top: 10vh;
  left: 40vh;
  transform: translateX(-50%);
  width: 50vw;

  @media (max-width: 768px) {
    top: 10vh;
    left: 50%;
    transform: translateX(-50%);
    width: 80vw;
  }
`;

const AwanKuningFlip = styled.img`
  ${tw`absolute`}
  top: 10vh;
  right: 40vh;
  transform: translateX(50%) scaleX(-1);
  width: 50vw;

  @media (max-width: 768px) {
    top: 10vh;
    right: 50%;
    transform: translateX(50%);
    width: 80vw;
  }
`;

const AwanContainer = styled.div`
  ${tw`absolute inset-0`}
  z-index: 4;
`;

function AnimationReveal({ disabled, children }) {
  if (disabled) {
    return <>{children}</>;
  }

  if (!Array.isArray(children)) children = [children];

  return <>{children}</>;
}


export default props => (
  <>
    <style>
      {`
        body {
          margin: 0;
          overflow-x: hidden;
        }
      `}
    </style>
    <StyledDiv className="App">
      <AwanContainer>
        <AwanKuning src="/img/landing-page/awan_kuning.svg" alt="Awan Kuning" />
        <AwanKuningFlip src="/img/landing-page/awan_kuning.svg" alt="Awan Kuning Flip" />
      </AwanContainer>
      <AnimationReveal {...props} />
    </StyledDiv>
  </>
);

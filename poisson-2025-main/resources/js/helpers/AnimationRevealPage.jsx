import React from "react";
import tw from "twin.macro";
import styled from "styled-components";

const StyledDiv = styled.div`
    ${tw`font-sans text-secondary-500 p-0 overflow-hidden`}
    background-color: #62D0CE;
    background-image: radial-gradient(
        circle,
        #9ef6f4,
        #62d0ce,
        #36bbb8,
        #9ef6f4
    );

    @media (max-width: 768px) {
        ${tw`py-4 px-1`}
    }
`;

function AnimationReveal({ disabled, children }) {
    if (disabled) {
        return <>{children}</>;
    }

    if (!Array.isArray(children)) children = [children];

    return <>{children}</>;
}

export default (props) => (
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
            <AnimationReveal {...props} />
        </StyledDiv>
    </>
);

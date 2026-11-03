import React from "react";
import styled from "styled-components";
import tw from "twin.macro";

const Wrapper = styled.div`
    ${tw`w-full h-[200px] relative bottom--24 lg:bottom--36 z-20 absolute`}
    background-image: url(${(props) => props.src});
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top center;
`;

const SectionTransition = ({ src }) => {
    return <Wrapper src={src} />;
};

export default SectionTransition;

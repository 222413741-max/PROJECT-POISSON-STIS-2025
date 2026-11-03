import React from "react";
import { ContextProvider } from "../helpers/Context";

import tw from "twin.macro";

const Container = tw.div`flex justify-center items-center h-screen bg-gray-100`;

export default function ComingSoon() {
    return (
        <ContextProvider>
					<Container>
						<h1>COBA AJA</h1>
					</Container>
        </ContextProvider>
    );
}
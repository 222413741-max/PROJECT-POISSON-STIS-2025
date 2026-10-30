import React from 'react'
import { useTranslation } from 'react-i18next'
import styled, { keyframes, css } from 'styled-components'

import tw from 'twin.macro'

const VideoContainer = styled.div`
  ${({ theme }) => css`
    ${tw`relative flex items-center justify-center w-full mt-8`}
    height: 85vh;
    width: 150vh;
    overflow: hidden;
    z-index: 5;
    margin: 0 auto;

    @media (max-width: 1024px) {
      height: 60vh;
      width: 90vw;
    }

    @media (max-width: 768px) {
      height: 50vh;
      width: 80vw;
    }

    @media (max-width: 425px) {
      height: 40vh;
      width: 90vw;
    }

    iframe {
      ${tw`absolute top-0 left-0 w-full h-full border-4 border-gray-300 rounded-lg`}
    }
  `}
`

const Text = styled.div`
  ${({ theme }) => css`
    ${tw`text-center text-xl font-semibold mb-4 text-gray-800`}
  `}
`

const VideoSection = () => {
  const { t } = useTranslation()

  return (
    <div>
      <Text>{t('comingsoon.submessage')}</Text>
      <VideoContainer>
        <iframe
          src="https://www.youtube.com/embed/Hadrc5PY5wU?si=olq6Ewq_nJM4vAih"
          title="YouTube video"
          frameBorder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowFullScreen
        ></iframe>
      </VideoContainer>
    </div>
  )
}

export default VideoSection

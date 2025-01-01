import React, { useRef } from "react";
import RelatedSlidBox from "./RelatedSlidBox";

const RelatedTopicsSlider = () => {
	const swiperRef = useRef(null);
	return <RelatedSlidBox swiperRef={swiperRef} />;
};

export default RelatedTopicsSlider;

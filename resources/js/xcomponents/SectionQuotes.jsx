import React from "react";

const SectionQuotes = ({ children, className = "" }) => {
	return (
		<h2
			className={`${className} text-right md:text-[34px] text-[20px] font-normal md:leading-[47.6px] leading-[24px] capitalize text-primary-600 md:w-[194px] w-[164px]`}>
			{children}
		</h2>
	);
};

export default SectionQuotes;

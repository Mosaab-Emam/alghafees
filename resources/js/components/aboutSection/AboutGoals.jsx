import React from "react";
import ParagraphContent from "../ParagraphContent";

const AboutGoals = ({ type, index, img, title, desc }) => {
	const lastItem = index === 2;
	const middleItem = index === 1;

	return (
		<div
			className={`
    flex justify-start items-center gap-5 min-w-[285px] max-w-full
    ${
			type === "about-page"
				? ""
				: lastItem
				? "mb-[50px] lg:mr-[50px] xl:mr-[100px] mr-0"
				: "mb-[80.3px]"
		}
    ${middleItem ? "lg:mr-[30px] xl:mr-[50px]" : ""}
  `.trim()}>
			<div className='w-[82px] h-[91px] flex-shrink-0'>
				<img
					className='w-full h-ful object-scale-down'
					src={img}
					alt={title}
					loading='lazy'
				/>
			</div>

			<div className='flex flex-col justify-center items-start gap-2 flex-shrink-0 w-[193px]'>
				<h3 className='text-[22px] font-normal leading-[30.8px] text-Black-01 text-center min-w-[116px] h-[25px]'>
					{title}
				</h3>

				<ParagraphContent>{desc}</ParagraphContent>
			</div>
		</div>
	);
};

export default AboutGoals;

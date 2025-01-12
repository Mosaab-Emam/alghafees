import React from "react";
import { ParagraphContent, TextContent } from "../../components";

const JoinUsTextBox = () => {
	return (
		<section className='md:absolute md:-bottom-[25rem] 2xl:w-[1300px] xl:w-[1200px] lg:w-[1024px] w-[312px] xl:h-[608px] lg:h-[408px] h-[974px] md:mt-0 -mt-16   glass-effect rounded-bl-[100px] border-[3px] border-primary-300 '>
			<section className='md:w-[370px] xl:w-[430px] 2xl:w-[470px] w-full flex flex-col items-start gap-4 xl:mt-[173px] lg:mt-[80px] xl:mb-[174px] lg:mb-[80px] mb-8 xl:mr-[50px] lg:mr-8 lg:p-4 p-6'>
				<TextContent
					headLineClass='md:head-line-h2 head-line-h3'
					align='text-right'>
					<>
						انضم إلى <span className='text-primary-600'> فريقنا </span> المتميز
						وساهم في تحقيق نجاحات جديدة
					</>
				</TextContent>
				<ParagraphContent>
					نبحث عن أفراد طموحين ومبدعين للانضمام إلى فريقنا.إذا كنت مستعدًا
					لتحديات جديدة وترغب في المساهمة في نجاحاتنا، نرحب بك لتكون جزءًا من
					عائلتنا المهنية.
				</ParagraphContent>
			</section>
		</section>
	);
};

export default JoinUsTextBox;

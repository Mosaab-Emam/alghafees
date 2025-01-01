import React from "react";
import SectionContentBox from "../SectionContentBox";

const TextContentBox = () => {
	return (
		<SectionContentBox
			sectionTitle='عملاؤنا'
			textContent={
				<>
					استمع إلى عملائنا كيف ساعدناهم في تحقيق{" "}
					<span className='text-primary-600'>أهدافهم العقارية</span> بنجاح
					واحترافية
				</>
			}
			paragraphContent='نحن فخورون بعملائنا الراضين الذين يشاركوننا تجاربهم الإيجابية. نؤمن أن أفضل دليل على جودة خدماتنا هو رضا عملائنا وثقتهم بنا. اكتشف ما يقوله عملاؤنا عن الاستشارات العقارية التي نقدمها، وكيف ساعدناهم في تحقيق أهدافهم العقارية بطريقة سلسة وموثوقة. انضم إلى مجموعة عملائنا السعداء وكن جزءًا من رحلتنا المتميزة'
			className='w-[492px] flex flex-col items-start gap-[32px]'
			textContentWidth='w-full'
			sectionTitleTextColor='text-primary-600'
			textContentTextColor='text-Black-01'
			paragraphContentTextColor='text-Gray-scale-02'
			butWidth='w-[180px]'
			navigateTo='/our-clients'
		/>
	);
};

export default TextContentBox;

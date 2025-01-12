import React from "react";
import BoxHeadline from "../BoxHeadline";

const values = [
	{ id: 1, value: "الإلتزام" },
	{ id: 2, value: "النزاهة" },
	{ id: 3, value: "السرية" },
	{ id: 4, value: "الكفاءة" },
	{ id: 5, value: "الموضوعية" },
];
const ValuesBox = () => {
	return (
		<div className='absolute  md:right-44 left-0 md:-bottom-[26.8rem] -bottom-2'>
			<div className='w-[181px] min-h-[327px] p-[32px] flex justify-end items-start gap-[10px] flex-shrink-0 glass-effect glass-effect-bg-primary-2 rounded-tr-[70px] rounded-bl-[70px]  '>
				<div className=' flex flex-col  items-start gap-8 flex-shrink-0'>
					<BoxHeadline headline='قيمنا' />
					{values.map((item) => (
						<div key={item.id} className='flex items-center gap-[9px]'>
							<span>
								<svg
									xmlns='http://www.w3.org/2000/svg'
									width='16'
									height='15'
									viewBox='0 0 16 15'
									fill='none'>
									<path
										d='M8 0L9.79611 5.52786H15.6085L10.9062 8.94427L12.7023 14.4721L8 11.0557L3.29772 14.4721L5.09383 8.94427L0.391548 5.52786H6.20389L8 0Z'
										fill='#0F819F'
									/>
								</svg>
							</span>
							<h5>{item.value}</h5>
						</div>
					))}
				</div>
			</div>
		</div>
	);
};

export default ValuesBox;

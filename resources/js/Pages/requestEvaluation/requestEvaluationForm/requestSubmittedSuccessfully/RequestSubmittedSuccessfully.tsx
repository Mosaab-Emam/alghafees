import React, { useState } from "react";
import { RequestSubmittedSuccessfullySvg } from "../../../../assets/icons";

const RequestSubmittedSuccessfully = () => {
	const [copied, setCopied] = useState(false);
	const requestNumber = "51dgd83clk";

	const handleCopyToClipboard = async () => {
		try {
			await navigator.clipboard.writeText(requestNumber);
			setCopied(true);

			setTimeout(() => setCopied(false), 3000); // Reset after 3 seconds
		} catch (err) {
			console.error("فشل في نسخ رقم الطلب: ", err);
		}
	};

	return (
		<div className='w-[299.991px] flex flex-col justify-center items-center gap-8 md:mt-[159px] mt-[50px]  mx-auto'>
			<div className='w-[262px] flex flex-col justify-center items-center self-stretch'>
				<RequestSubmittedSuccessfullySvg />
			</div>

			<div className=' flex flex-col justify-center items-center self-stretch gap-2'>
				<h3 className='head-line-h3 text-center text-Black-01'>
					تم تقديم طلبك بنجاح!
				</h3>

				<div className='flex flex-col items-center self-stretch gap-8'>
					<p className='regular-b1 text-center text-Gray-scale-02'>
						شكرًا لك على تقديم طلب تقييم العقار! نحن نعمل الآن على معالجة طلبك
						وسنتواصل معك قريبًا للحصول على التفاصيل اللازمة. إذا كان لديك أي
						استفسارات، لا تتردد في الاتصال بنا.
					</p>
					<div className='flex justify-center items-center gap-[14px]'>
						<p className='regular-b1 text-center text-Black-01'>
							رقم طلبك : {requestNumber}
						</p>
						<button
							type='button'
							onClick={handleCopyToClipboard}
							className='w-[30px] height-[30px]'>
							{copied ? (
								<svg
									xmlns='http://www.w3.org/2000/svg'
									width='30'
									height='31'
									viewBox='0 0 30 31'
									fill='none'>
									<path
										d='M12 22.5L4 14.5L7 11.5L12 16.5L24 4.5L27 7.5L12 22.5Z'
										fill='#0F819F'
									/>
								</svg>
							) : (
								<svg
									xmlns='http://www.w3.org/2000/svg'
									width='30'
									height='31'
									viewBox='0 0 30 31'
									fill='none'>
									<path
										opacity='0.976'
										fillRule='evenodd'
										clipRule='evenodd'
										d='M11.3934 2.45776C15.4559 2.448 19.5184 2.45776 23.5809 2.48706C25.8172 2.84839 27.116 4.14722 27.4773 6.38355C27.5348 11.014 27.5152 15.6429 27.4188 20.2703C26.9205 22.2919 25.6413 23.454 23.5809 23.7566C23.1907 23.7859 22.8001 23.7956 22.409 23.7859C22.144 25.3996 21.2651 26.5422 19.7723 27.2136C19.3772 27.3759 18.9671 27.4735 18.5418 27.5066C14.4793 27.5457 10.4168 27.5457 6.3543 27.5066C4.11774 27.145 2.81891 25.8462 2.45781 23.6101C2.40054 19.3898 2.42007 15.171 2.51641 10.9539C2.96732 9.05765 4.14897 7.91507 6.06133 7.52612C6.52967 7.49683 6.99842 7.4871 7.46758 7.49683C7.2833 5.13834 8.2794 3.52701 10.4559 2.66284C10.7726 2.57517 11.0851 2.50682 11.3934 2.45776ZM11.452 5.03589C15.4754 5.02612 19.4989 5.03589 23.5223 5.06519C24.2547 5.25074 24.7137 5.70972 24.8992 6.44214C24.9383 10.8953 24.9383 15.3484 24.8992 19.8015C24.7137 20.5339 24.2547 20.9929 23.5223 21.1785C23.1712 21.2077 22.8197 21.2175 22.4676 21.2078C22.4774 17.8288 22.4676 14.4499 22.4383 11.071C21.9988 9.14724 20.8172 7.96558 18.8934 7.52612C15.9247 7.49683 12.9559 7.48704 9.98711 7.49683C9.82088 6.26431 10.3091 5.44398 11.452 5.03589ZM6.53008 10.0164C10.4754 10.0066 14.4207 10.0164 18.366 10.0457C19.2351 10.2117 19.7528 10.7293 19.9188 11.5984C19.9578 15.5437 19.9578 19.489 19.9188 23.4343C19.7376 24.2209 19.259 24.7189 18.4832 24.9285C14.4597 24.9676 10.4364 24.9676 6.41289 24.9285C5.68047 24.7429 5.22149 24.2839 5.03594 23.5515C4.99688 19.5281 4.99688 15.5047 5.03594 11.4812C5.25594 10.7045 5.75399 10.2162 6.53008 10.0164Z'
										fill='#0F819F'
									/>
								</svg>
							)}
						</button>
					</div>
				</div>
			</div>
		</div>
	);
};

export default RequestSubmittedSuccessfully;

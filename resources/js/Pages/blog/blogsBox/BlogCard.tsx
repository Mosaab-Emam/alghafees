import { Post } from "@/types";
import { Link } from "@inertiajs/react";
import { CalenderIcon } from "../../../assets/images/blog";
import { Button } from "../../../components";
import BlogIcon from "../BlogIcon";

export default function BlogCard({
    post,
    isLatestTopic,
}: {
    post: Post;
    isLatestTopic: boolean;
}) {
    return (
        <Link
            href={`/blog/${post.slug}`}
            className="blog-card 2xl:w-[410px] 2xl:max-h-[570px] w-full max-h-[555px] flex items-center gap-[10px] rounded-tl-[100px] bg-bg-01 border border-bg-01 shadow-[12px_12px_35px_0px_rgba(29,42,45,0.07)]"
        >
            <div className="flex flex-col items-start flex-1 gap-6">
                <div className="h-[226px] self-stretch rounded-tl-[100px]">
                    <img
                        className="w-full h-full object-cover rounded-tl-[100px]"
                        src={
                            post.featured_image
                                ? post.featured_image
                                : "/default-post-image.jpg"
                        }
                        alt={post.title.ar}
                        loading="lazy"
                    />
                </div>

                <div className="flex flex-col items-start  gap-6 self-stretch p-4 pt-0">
                    <div className="flex flex-col items-start  gap-4 self-stretch">
                        <div className="flex justify-between items-start self-stretch">
                            <div className="flex items-center gap-2">
                                <CalenderIcon className="w-5 h-5" />
                                <p className=" regular-b1 text-right text-Gray-scale-02">
                                    {post.published_at.slice(0, 10)}
                                </p>
                            </div>
                        </div>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="308"
                            height="2"
                            viewBox="0 0 308 2"
                            fill="none"
                        >
                            <path
                                d="M307 1H1"
                                stroke="#CFE6EC"
                                strokeLinecap="round"
                            />
                        </svg>
                    </div>

                    <div className="flex flex-col items-start gap-8 self-stretch">
                        <div className="flex flex-col items-start gap-2 self-stretch">
                            <div className="flex  items-center gap-[20px] self-stretch">
                                <BlogIcon
                                    color="#51656A"
                                    width="24"
                                    height="24"
                                />
                                <h4 className="head-line-h4 text-right text-Black-01">
                                    {post.title.ar}
                                </h4>
                            </div>
                            <p className="regular-b1 text-right text-Gray-scale-02 text-ellipsis line-clamp-3">
                                {post.description.ar}
                            </p>
                        </div>
                    </div>

                    {/* {!isLatestTopic && ( */}
                    <div className="flex justify-between items-center self-stretch">
                        <Link href={`/blog/${post.slug}`}>
                            <Button
                                variant="primary"
                                className={
                                    "h-[40px] md:py-[15px] py-[14px] md:px-[80px] px-[60px]"
                                }
                            >
                                قراءة المزيد
                            </Button>
                        </Link>
                    </div>
                    {/* )} */}
                </div>
            </div>
        </Link>
    );
}

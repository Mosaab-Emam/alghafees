import { Post } from "@/types";
import "../../../../../css/blog.css";
import BlogIcon from "../../../blog/BlogIcon";

export default function ArticleBoxDetails({ post }: { post: Post }) {
    return (
        <div className="2xl:w-[820px] xl:w-[793px] lg:w-[650px] w-full h-auto rounded-tl-[100px] rounded-br-[100px] border border-primary-600 bg-bg-01 py-[34px] px-[32px] md:mb-0 mb-[50px]">
            <div className="xl:w-[722px] lg:w-full w-full flex flex-col items-start gap-8">
                <div
                    id="post-content"
                    className="flex flex-col items-start gap-[14px] self-stretch"
                >
                    <BlogIcon color={"#0F819F"} width="34px" height="34px" />
                    <div
                        dangerouslySetInnerHTML={{
                            __html: post.content.ar,
                        }}
                    />
                </div>
            </div>
        </div>
    );
}

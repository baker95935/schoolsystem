// quzao.cpp : ∂®“Âøÿ÷∆Ã®”¶”√≥Ã–Úµƒ»Îø⁄µ„°£
//

//#include "stdafx.h"

#include <opencv2/core/core.hpp>
#include <opencv2/objdetect/objdetect.hpp>
#include <opencv2/highgui/highgui.hpp>
#include <opencv2/imgproc/imgproc.hpp>
#include <vector>
#include <iostream>
using namespace std;
using namespace cv;


void RemoveSmallRegion(Mat &Src, Mat &Dst, int AreaLimit, int CheckMode, int NeihborMode)
{
    int RemoveCount = 0;
    //–¬Ω®“ª∑˘±Í«©ÕºœÒ≥ı ºªØŒ™0œÒÀÿµ„£¨Œ™¡Àº«¬º√ø∏ˆœÒÀÿµ„ºÏ—È◊¥Ã¨µƒ±Í«©£¨0¥˙±ÌŒ¥ºÏ≤È£¨1¥˙±Ì’˝‘⁄ºÏ≤È,2¥˙±ÌºÏ≤È≤ª∫œ∏Ò£®–Ë“™∑¥◊™—’…´£©£¨3¥˙±ÌºÏ≤È∫œ∏ÒªÚ≤ª–ËºÏ≤È
    //≥ı ºªØµƒÕºœÒ»´≤øŒ™0£¨Œ¥ºÏ≤È
    Mat PointLabel = Mat::zeros(Src.size(), CV_8UC1);
    if (CheckMode == 1)//»•≥˝–°¡¨Õ®«¯”Úµƒ∞◊…´µ„
    {
        //    cout << "»•≥˝–°¡¨Õ®”Ú.";
        for (int i = 0; i < Src.rows; i++)
        {
            for (int j = 0; j < Src.cols; j++)
            {
                if (Src.at<uchar>(i, j) < 10)
                {
                    PointLabel.at<uchar>(i, j) = 3;//Ω´±≥æ∞∫⁄…´µ„±Íº«Œ™∫œ∏Ò£¨œÒÀÿŒ™3
                }
            }
        }
    }
    else//»•≥˝ø◊∂¥£¨∫⁄…´µ„œÒÀÿ
    {
        //cout << "»•≥˝ø◊∂¥";
        for (int i = 0; i < Src.rows; i++)
        {
            for (int j = 0; j < Src.cols; j++)
            {
                if (Src.at<uchar>(i, j) > 10)
                {
                    PointLabel.at<uchar>(i, j) = 3;//»Áπ˚‘≠Õº «∞◊…´«¯”Ú£¨±Íº«Œ™∫œ∏Ò£¨œÒÀÿŒ™3
                }
            }
        }
    }
    
    
    vector<Point2i>NeihborPos;//Ω´¡⁄”Ú—πΩ¯»›∆˜
    NeihborPos.push_back(Point2i(-1, 0));
    NeihborPos.push_back(Point2i(1, 0));
    NeihborPos.push_back(Point2i(0, -1));
    NeihborPos.push_back(Point2i(0, 1));
    if (NeihborMode == 1)
    {
        //cout << "Neighbor mode: 8¡⁄”Ú." << endl;
        NeihborPos.push_back(Point2i(-1, -1));
        NeihborPos.push_back(Point2i(-1, 1));
        NeihborPos.push_back(Point2i(1, -1));
        NeihborPos.push_back(Point2i(1, 1));
    }
    //    else cout << "Neighbor mode: 4¡⁄”Ú." << endl;
    int NeihborCount = 4 + 4 * NeihborMode;
    int CurrX = 0, CurrY = 0;
    //ø™ ººÏ≤‚
    for (int i = 0; i < Src.rows; i++)
    {
        for (int j = 0; j < Src.cols; j++)
        {
            if (PointLabel.at<uchar>(i, j) == 0)//±Í«©ÕºœÒœÒÀÿµ„Œ™0£¨±Ì æªπŒ¥ºÏ≤Èµƒ≤ª∫œ∏Òµ„
            {   //ø™ ººÏ≤È
                vector<Point2i>GrowBuffer;//º«¬ººÏ≤ÈœÒÀÿµ„µƒ∏ˆ ˝
                GrowBuffer.push_back(Point2i(j, i));
                PointLabel.at<uchar>(i, j) = 1;//±Íº«Œ™’˝‘⁄ºÏ≤È
                int CheckResult = 0;
                
                
                for (int z = 0; z < GrowBuffer.size(); z++)
                {
                    for (int q = 0; q < NeihborCount; q++)
                    {
                        CurrX = GrowBuffer.at(z).x + NeihborPos.at(q).x;
                        CurrY = GrowBuffer.at(z).y + NeihborPos.at(q).y;
                        if (CurrX >= 0 && CurrX<Src.cols&&CurrY >= 0 && CurrY<Src.rows)  //∑¿÷π‘ΩΩÁ
                        {
                            if (PointLabel.at<uchar>(CurrY, CurrX) == 0)
                            {
                                GrowBuffer.push_back(Point2i(CurrX, CurrY));  //¡⁄”Úµ„º”»Îbuffer
                                PointLabel.at<uchar>(CurrY, CurrX) = 1;           //∏¸–¬¡⁄”Úµ„µƒºÏ≤È±Í«©£¨±‹√‚÷ÿ∏¥ºÏ≤È
                            }
                        }
                    }
                }
                if (GrowBuffer.size()>AreaLimit) //≈–∂œΩ·π˚£® «∑Ò≥¨≥ˆœﬁ∂®µƒ¥Û–°£©£¨1Œ™Œ¥≥¨≥ˆ£¨2Œ™≥¨≥ˆ
                    CheckResult = 2;
                else
                {
                    CheckResult = 1;
                    RemoveCount++;//º«¬º”–∂‡…Ÿ«¯”Ú±ª»•≥˝
                }
                
                
                for (int z = 0; z < GrowBuffer.size(); z++)
                {
                    CurrX = GrowBuffer.at(z).x;
                    CurrY = GrowBuffer.at(z).y;
                    PointLabel.at<uchar>(CurrY, CurrX) += CheckResult;//±Íº«≤ª∫œ∏ÒµƒœÒÀÿµ„£¨œÒÀÿ÷µŒ™2
                }
                //********Ω· ¯∏√µ„¥¶µƒºÏ≤È**********
                
                
            }
        }
        
        
    }
    
    
    CheckMode = 255 * (1 - CheckMode);
    //ø™ º∑¥◊™√Êª˝π˝–°µƒ«¯”Ú
    for (int i = 0; i < Src.rows; ++i)
    {
        for (int j = 0; j < Src.cols; ++j)
        {
            if (PointLabel.at<uchar>(i, j) == 2)
            {
                Dst.at<uchar>(i, j) = CheckMode;
            }
            else if (PointLabel.at<uchar>(i, j) == 3)
            {
                Dst.at<uchar>(i, j) = Src.at<uchar>(i, j);
                
            }
        }
    }
    //cout << RemoveCount << " objects removed." << endl;
}

//int _tmain(int argc, _TCHAR* argv[])
int main(int argc,char** argv)
{
    if(argc!=2)
    {
        exit(0);
    }
    string address = argv[1];
    Mat srcimg=cv::imread(address,0);
    Mat bwimg;
    Mat resimg;

    threshold(srcimg, bwimg, 140, 1, CV_THRESH_BINARY_INV);
    
    RemoveSmallRegion(bwimg, bwimg, 10, 1, 8);
    resimg = (255 - srcimg).mul(bwimg);
    resimg = 255 - resimg;
//    namedWindow("3", 0);
//    cvResizeWindow("3", 640, 480);
    
    imwrite(address, resimg);
//    waitKey(0);
    return 0;
}


